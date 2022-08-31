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
    var base_url = window.location.origin + window.location.pathname;

    $.ajax({
        url: base_url+"/mostrar",
        type:"POST",
        data:{buscar:valor, numpagina:pagina},
        dataType:"json",
        success:function(respuesta){
            html = "";
            $.each(respuesta.usuarios, function(key, item){
                html += "<tr><th scope='row'>"+item.curp+"</th><td>"+item.nombre+"</td><td>"+item.apellidoP+"</td><td>"+item.apellidoM+"</td><td><center><a class='btn btn-primary' href='"+base_url+"/"+item.idUsuario+"' role='button'>Editar</a></center></td></tr>";
            });
            $("#listaUsuarios").html(html);


            linkseleccionado = Number(pagina);
            var articulosPag = Math.ceil(respuesta.cantidadUsuarios/5);
            paginador = "";

            if(linkseleccionado>1){
                paginador+="<li class='page-item'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item'><a class='page-link' href='"+(linkseleccionado-1)+"'>&lsaquo;</a></li>";
            }else{
                paginador+="<li class='page-item disabled'><a class='page-link' href='1'>&laquo;</a></li>";
                paginador+="<li class='page-item disabled'><a class='page-link' href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";
            }
            for(var i = 1; i <= articulosPag; i++){
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

