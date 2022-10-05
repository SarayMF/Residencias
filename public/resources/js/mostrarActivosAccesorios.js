$(document).ready(inicio);

function inicio(){
    mostrarActivos("",1);
    mostrarAccesorios("",1);

    $("#buscar").keyup(function(){
        buscar = $("#buscar").val();
        mostrarActivos(buscar,1);
    });
    $("#buscarA").keyup(function(){
        buscar = $("#buscarA").val();
        mostrarAccesorios(buscar,1);
    });

    $("body").on("click",".activos-pag li a", function(e){
        e.preventDefault();
        valorhref = $(this).attr('href');
        valorbuscar = $("#buscar").val();
        mostrarActivos(valorbuscar,valorhref);
    });

    $("body").on("click",".accesorios-pag li a", function(e){
        e.preventDefault();
        valorhref = $(this).attr('href');
        valorbuscar = $("#buscarA").val();
        mostrarAccesorios(valorbuscar,valorhref);
    });
}

function mostrarActivos(valor, pagina){
    document.getElementById('loader').classList.add('loader');
    var base_url = window.location.origin + window.location.pathname;

    $.ajax({
        url: base_url+"/mostrar activos",
        type:"POST",
        data:{buscar:valor, numpagina:pagina},
        dataType:"json",
        success:function(respuesta){
            document.getElementById('loader').classList.remove('loader');
            type = $("#type").val();
            html = "";
            $.each(respuesta.activos, function(key, item){
                html += "<tr><th scope='row'>"+item.noActivo+"</th><td>"+item.noSerie+"</td><td>"+item.marca+"</td><td>"+item.modelo+"</td><td>"+item.fechaAlta+"</td>";
                if(type == "Entrada") html += "<td><center><a class='btn btn-primary' href='"+base_url+"/editar/"+item.idActivo+"' role='button'>Editar</a></center></td><td><center><a class='btn btn-info' href='"+base_url+"/asignar/"+item.idActivo+"' role='button'>Asignar</a></center></td></tr>";
                else if(type == "Salida") html += "<td><center><button class='btn btn-danger' onClick='eliminarActivo("+item.idActivo+")'>Eliminar</button></center></td></tr>";
            });
            $("#listaActivos").html(html);


            linkseleccionado = Number(pagina);
            var articulosPag = Math.ceil(respuesta.cantidadActivos/10);
            paginador = "";

            if(linkseleccionado>1){
                paginador+="<li class='page-item'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item'><a class='page-link' href='"+(linkseleccionado-1)+"'>&lsaquo;</a></li>";
            }else{
                paginador+="<li class='page-item disabled'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item disabled'><a class='page-link' href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";
            }

            cant = 3;
            pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
            if(articulosPag > cant){
                pagRestantes = articulosPag - linkseleccionado;
                pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :articulosPag;
            }else{
                pagFin = articulosPag;
            }

            for(var i = pagInicio; i <= pagFin; i++){
                if(i == linkseleccionado) paginador+="<li class='page-item active'><a class='page-link' href='javascript:void(0)'>"+i+"</a></li>";
                else paginador+="<li class='page-item'><a class='page-link' href='"+i+"'>"+i+"</a></li>";
            }
            if(linkseleccionado<articulosPag){
                paginador+="<li class='page-item'><a class='page-link' href='"+(linkseleccionado+1)+"'>&rsaquo;</a></li>";
                paginador+="<li class='page-item'><a class='page-link' href='"+articulosPag+"'>&raquo;</a></li>";
            }else{
                paginador+="<li class='page-item disabled'><a class='page-link' href='#'>&rsaquo;</a></li>";
                paginador+="<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>";
            }
            $("#paginacion ul").html(paginador);
        }
    });
}

function eliminarActivo(idActivo){
    var base_url = window.location.origin + window.location.pathname;
    swal({
        title: "¿Estas seguro de dar de baja este registro?",
        text: "Una vez eliminado, no seras capaz de recuperarlo",
        icon: "warning",
        dangerMode: true,
        buttons: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url+"/eliminar activo",
                type:"POST",
                data: {activo:idActivo},
                dataType:"json",
                success:function(respuesta){
                    swal({
                        title: respuesta.title,
                        text: respuesta.mensaje,
                        icon: respuesta.type,
                    }).then((value) => {
                        mostrarActivos("", 1);
                    });
                },
            });
          
        } else {
          swal("Accion cancelada");
        }
      });
}

function mostrarAccesorios(valor, pagina){
    document.getElementById('loaderA').classList.add('loader');
    var base_url = window.location.origin + window.location.pathname;

    $.ajax({
        url: base_url+"/mostrar accesorios",
        type:"POST",
        data:{buscar:valor, numpagina:pagina},
        dataType:"json",
        success:function(respuesta){
            document.getElementById('loaderA').classList.remove('loader');
            type = $("#type").val();
            html = "";
            $.each(respuesta.accesorios, function(key, item){
                html += "<tr><th scope='row'>"+item.idAccesorio+"</th><td>"+item.nombre+"</td><td>"+item.cantidad+"</td>";
                if(type == "Entrada") html += "<td><center><a class='btn btn-primary' href='"+base_url+"/editar accesorio/"+item.idAccesorio+"' role='button'>Editar</a></center></td><td><center><a class='btn btn-info' href='"+base_url+"/asignar accesorio/"+item.idAccesorio+"' role='button'>Asignar</a></center></td></tr>";
                else if(type == "Salida") html += "<td><center><button class='btn btn-danger' onClick='eliminarAccesorio("+item.idAccesorio+")'>Eliminar</button></center></td></tr>";
            });
            $("#listaAccesorios").html(html);


            linkseleccionado = Number(pagina);
            var articulosPag = Math.ceil(respuesta.cantidadAccesorios/5);
            paginador = "";

            if(linkseleccionado>1){
                paginador+="<li class='page-item'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item'><a class='page-link' href='"+(linkseleccionado-1)+"'>&lsaquo;</a></li>";
            }else{
                paginador+="<li class='page-item disabled'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item disabled'><a class='page-link' href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";
            }

            cant = 3;
            pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
            if(articulosPag > cant){
                pagRestantes = articulosPag - linkseleccionado;
                pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :articulosPag;
            }else{
                pagFin = articulosPag;
            }

            for(var i = pagInicio; i <= pagFin; i++){
                if(i == linkseleccionado) paginador+="<li class='page-item active'><a class='page-link' href='javascript:void(0)'>"+i+"</a></li>";
                else paginador+="<li class='page-item'><a class='page-link' href='"+i+"'>"+i+"</a></li>";
            }
            if(linkseleccionado<articulosPag){
                paginador+="<li class='page-item'><a class='page-link' href='"+(linkseleccionado+1)+"'>&rsaquo;</a></li>";
                paginador+="<li class='page-item'><a class='page-link' href='"+articulosPag+"'>&raquo;</a></li>";
            }else{
                paginador+="<li class='page-item disabled'><a class='page-link' href='#'>&rsaquo;</a></li>";
                paginador+="<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>";
            }
            $("#paginacionA ul").html(paginador);
        }
    });
}

function eliminarAccesorio(id){
    var base_url = window.location.origin + window.location.pathname;
    swal({
        title: "¿Seguro quieres borrar este registro?",
        text: "Se disminuira 1 el inventario",
        icon: "warning",
        dangerMode: true,
        buttons: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url+"/eliminar accesorio",
                type:"POST",
                data: {accesorio:id},
                dataType:"json",
                success:function(respuesta){
                    swal({
                        title: respuesta.title,
                        text: respuesta.mensaje,
                        icon: respuesta.type,
                    }).then((value) => {
                        mostrarAccesorios("", 1);
                    });
                },
            });
          
        } else {
          swal("Accion cancelada");
        }
      });
}