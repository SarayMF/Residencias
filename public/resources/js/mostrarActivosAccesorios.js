$(document).ready(inicio);

function inicio(){
    mostrarDatos("",1);

    $("#buscar").keyup(function(){
        buscar = $("#buscar").val();
        mostrarDatos(buscar,1);
    });

    $("body").on("click",".pagination li a", function(e){
        e.preventDefault();
        valorhref = $(this).attr('href');
        valorbuscar = $("#buscar").val();
        mostrarDatos(valorbuscar,valorhref);
    })
}

function mostrarDatos(valor, pagina){
    document.getElementById('loader').classList.add('loader');
    var base_url = window.location.origin + window.location.pathname;

    $.ajax({
        url: base_url+"/mostrar",
        type:"POST",
        data:{buscar:valor, numpagina:pagina},
        dataType:"json",
        success:function(respuesta){
            document.getElementById('loader').classList.remove('loader');
            html = "";
            $.each(respuesta.activos, function(key, item){
                html += "<tr><th scope='row'>"+item.noActivo+"</th><td>"+item.noSerie+"</td><td>"+item.marca+"</td><td>"+item.modelo+"</td><td>"+item.fechaAlta+"</td><td><center><a class='btn btn-primary' href='"+base_url+"/editar"+item.idActivo+"' role='button'>Editar</a></center></td><td><center><a class='btn btn-info' href='"+base_url+"/asignar/"+item.idActivo+"' role='button'>Asignar</a></center></td></tr>";
            });
            $("#listaActivos").html(html);


            linkseleccionado = Number(pagina);
            var articulosPag = Math.ceil(respuesta.cantidadActivos/5);
            paginador = "";

            if(linkseleccionado>1){
                paginador+="<li class='page-item'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item'><a class='page-link' href='"+(linkseleccionado-1)+"'>&lsaquo;</a></li>";
            }else{
                paginador+="<li class='page-item disabled'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item disabled'><a class='page-link' href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";
            }

            cant = 3;
            pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) :articulosPag;

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