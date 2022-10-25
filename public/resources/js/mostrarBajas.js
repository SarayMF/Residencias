$(document).ready(inicio);

function inicio(){
    mostrarActivos("",1);

    $("#buscar").keyup(function(){
        buscar = $("#buscar").val();
        mostrarActivos(buscar,1);
    });

    $("body").on("click",".activos-pag li a", function(e){
        e.preventDefault();
        valorhref = $(this).attr('href');
        valorbuscar = $("#buscar").val();
        mostrarActivos(valorbuscar,valorhref);
    });
}

function mostrarActivos(valor, pagina){
    document.getElementById('loader').classList.add('loader');

    $.ajax({
        url: "mostrar bajas",
        type:"POST",
        data:{buscar:valor, numpagina:pagina},
        dataType:"json",
        success:function(respuesta){
            document.getElementById('loader').classList.remove('loader');
            type = $("#type").val();
            html = "";
            $.each(respuesta.activos, function(key, item){
                html += "<tr><th scope='row'>"+item.noActivo+"</th><td>"+item.noSerie+"</td><td>"+item.marca+"</td><td>"+item.modelo+"</td><td>"+item.fechaBaja+"</td><td>"+item.nombre+" "+item.apellidoP+" "+item.apellidoM+"</td></tr>";
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
                if(i == linkseleccionado) paginador+="<li class='page-item active'><a class='page-link' href='"+linkseleccionado+"'>"+i+"</a></li>";
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