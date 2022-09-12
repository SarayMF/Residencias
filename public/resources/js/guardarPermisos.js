$(document).ready(inicio);

function inicio(){
    $("#formulario").submit(function(ev){
        document.getElementById('loader').classList.add('loader');
        ev.preventDefault();
        permisos = [];
        $("input[type=checkbox]:checked").each(function(){
            permisos.push($(this).val());
        });

        data = {
            'idUsuario':$('#idUsuario').val(),
            'permisos':JSON.stringify(permisos),
        };
        
        $.ajax({
            url: 'guardarPermisos',
            type: 'POST',
            data: data,
            dataType:"json",
            success: function(response){
                document.getElementById('loader').classList.remove('loader');
                swal({
                    title: response.title,
                    text: response.mensaje,
                    icon: response.type,
                });
            },
        });
    });
}