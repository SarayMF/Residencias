$(document).ready(inicio);

function inicio(){
    $("#formulario").submit(function(ev){
        document.getElementById('loader').classList.add('loader');
        ev.preventDefault();
        var data = {
            'nombre':$('#nombre').val().toUpperCase(),
            'cantidad':$('#cantidad').val().toUpperCase(),
        };
        $.ajax({
            url: $('#idAccesorio').val(),
            type: 'POST',
            data: data,
            dataType:"json",
            success: function(response){
                document.getElementById('loader').classList.remove('loader');
                swal({
                    title: response.title,
                    text: response.mensaje,
                    icon: response.type,
                }).then((value) => {
                    var array = window.location.pathname.split( '/' );
                    array.pop();    
                    array.pop();
                    window.location.replace(window.location.origin + array.join("/"));
                });
            }
        });
    });
}
