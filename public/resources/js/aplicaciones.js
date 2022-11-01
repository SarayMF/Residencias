$(document).ready(inicio);

function inicio(){
    $("#agregar").click(function(){
        agregarAplicacion($( "#listaAplicaciones" ).val(), $( "#listaAplicaciones option:selected" ).text());
    })
}


function agregarAplicacion(id, nombre){
    html="<div class='row' id='aplicacion"+id+"'>";
    html+="<div class='input-group mb-3 col-12 col-sm-12'>";
    html+="<input type='text' class='form-control' value='"+nombre+"' readonly>"
    html+="<div class='input-group-append'>";
    html+="<button class='btn btn-outline-secondary' type='button' onClick='borrarAplicacion("+id+")'>Borrar</button>";
    html+="</div></div></div></div>";
    $("#aplicaciones").append(html);
}

function borrarAplicacion(id){
    $('#aplicacion'+id).remove();
}