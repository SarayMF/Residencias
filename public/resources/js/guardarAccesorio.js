$(document).ready(inicio);

function inicio(){
    $("#formulario").submit(function(ev){
        document.getElementById('loader').classList.add('loader');
        ev.preventDefault();
        var data = {
            'nombre':$('#nombre').val(),
            'cantidad':$('#cantidad').val(),
        };
        $.ajax({
            url: 'guardarAccesorio',
            type: 'POST',
            data: data,
            dataType:"json",
            success: function(response){
                document.getElementById('loader').classList.remove('loader');
                swal({
                    title: response.titulo,
                    text: response.mensaje,
                    icon: response.tipo,
                }).then((value) => {
                    var array = window.location.pathname.split( '/' );
                    array.pop();    
                    window.location.replace(window.location.origin + array.join("/"));
                });
                
            }
        });
    });
}
