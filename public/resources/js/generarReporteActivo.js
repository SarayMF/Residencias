$(document).ready(inicio);

function inicio(){
    document.getElementById("excel").onclick = function() { generarExcel() };
}

function generarExcel(){
    $.ajax({
        url: "generar reporte",
        type:"GET",
        dataType:"json",
        success:function(respuesta){
            console.log(respuesta)
        }
    });
}