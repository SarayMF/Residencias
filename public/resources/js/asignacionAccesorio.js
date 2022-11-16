$(document).ready(inicio);

function inicio(){
    $("#guardar").removeAttr('disabled');
    $("#buscarUsuario" ).select2();
    $("#formularioAsignacion").submit(function(ev){
        ev.preventDefault();
        guardarAsignacion();
    });
}

function guardarAsignacion(){
    var data = {
        'idAccesorio':$('#idAccesorio').val(),
        'cantidad':$('#cantidad').val(),
        'usuarioAsignado':$('#buscarUsuario').val(),
        'observaciones':$('#observaciones').val().toUpperCase(),
    };
    $.ajax({
        url: "guardarAsignacion",
        type:"POST",
        data: data,
        dataType:"json",
        success:function(respuesta){
            if(respuesta.type == "success"){
                swal({
                    title: respuesta.title,
                    text: respuesta.mensaje,
                    icon: respuesta.type,
                }).then((value) => {  
                    var array = window.location.pathname.split( '/' );
                    array.pop();    
                    array.pop();
                    window.location.replace(window.location.origin + array.join("/"));
                });
            }else{
                swal({
                    title: respuesta.title,
                    text: respuesta.mensaje,
                    icon: respuesta.type,
                });
            }
        }
    });
}