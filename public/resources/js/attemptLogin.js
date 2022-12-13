$(document).ready(inicio);

function inicio(){
    $("#formLogin").submit(function(ev){
        ev.preventDefault();
        iniciarSesion();
    });
}

function iniciarSesion(){
    data = {
        'correo':$('#correo').val(),
        'contraseña':$('#contraseña').val()
    };
    $.ajax({
        url: "login",
        type: 'POST',
        data: data,
        dataType:"json",
        success: function(response){
            
        }
    })
}