$(document).ready(inicio);

function inicio(){
    $("#formulario").submit(function(ev){
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
                swal({
                    title: response.title,
                    text: response.mensaje,
                    icon: response.type,
                });
            },
        });
    });
}