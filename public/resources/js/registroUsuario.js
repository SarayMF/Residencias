$(document).ready(inicio);

function inicio(){
    $("#formulario").submit(function(ev){
        ev.preventDefault();
        var data = {
            'curp':$('#curp').val(),
            'nombre':$('#nombre').val(),
            'apellidoP':$('#apellidoP').val(),
            'apellidoM':$('#apellidoM').val(),
            'puesto':$('#puesto').val(),
            'area':$('#area').val(),
            'correo':$('#correo').val(),
        };
        $.ajax({
            url: 'registro',
            type: 'POST',
            data: data,
            dataType:"json",
            success: function(response){
                swal({
                    title: response.title,
                    text: response.mensaje,
                    icon: response.icon,
                });
                window.location.replace(window.location.origin + window.location.pathname);
            },
            error: function(){

            },
        });
    });
}
