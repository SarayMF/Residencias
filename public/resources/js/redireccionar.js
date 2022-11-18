$(document).ready(inicio);

function inicio(){
    $("#cancelar").click(function(){cancelar();});
}

function cancelar(){
    var array = window.location.pathname.split( '/' );
    array.pop();    
    window.location.replace(window.location.origin + array.join("/"));
}