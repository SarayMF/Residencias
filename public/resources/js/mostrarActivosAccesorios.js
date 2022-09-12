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

        }
    }
}