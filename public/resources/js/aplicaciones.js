$(document).ready(inicio);

function inicio(){
    $("#agregar").click(function(){
        agregarAplicacion($( "#listaAplicaciones" ).val(), $( "#listaAplicaciones option:selected" ).text());
        $( "#listaAplicaciones option:selected" ).prop('disabled', true);
        $( "#listaAplicaciones option:selected" ).next().attr('selected', 'selected');
    })
}


function agregarAplicacion(id, nombre){
    console.log(id);
    html="<div class='row' id='aplicacion"+id+"'>";
    html+="<div class='input-group mb-3 col-12 col-sm-12'>";
    html+="<div class='input-group-prepend'>";
    html+="<div class='input-group-text'>";
    html+="<input type='checkbox' value='"+id+"' checked='true' disabled>";
    html+="</div></div>";
    html+="<input type='text' class='form-control' value='"+nombre+"' readonly>";
    html+="<div class='input-group-append'>";
    html+="<button class='btn btn-outline-secondary' type='button' onClick='borrarAplicacion("+id+")'>Borrar</button>";
    html+="</div></div></div></div>";
    $("#aplicaciones").append(html);
}

function borrarAplicacion(id){
    $('#aplicacion'+id).remove();
    $("#listaAplicaciones option[value='"+id+"']").prop('disabled', false);
    $("#listaAplicaciones option[value='"+id+"']").next().removeAttr('selected');
}