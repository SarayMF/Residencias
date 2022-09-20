$(document).ready(inicio);

function inicio(){
    $("#formulario-cont").submit(function(ev){
        ev.preventDefault();
        document.getElementById('loader').classList.add('loader');
        contraseña1 = $('#password1').val();
        contraseña2 = $('#password2').val();
        if(contraseña1 == contraseña2){
            base_url = $('#url').val();
            data = {
                'contraseña':$('#password1').val(),
                'idUsuario':$('#idUsuario').val(),
                'token':$('#token').val(),
            };
            $.ajax({
                url: base_url+'/registrarContraseña',
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
                        window.location.replace(base_url);
                    });
                }
            });
        }else{
            html="<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
            html+="<p class='error-form-validation'>Las contraseñas no coinciden</p>";
            html+="<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            html+="<span aria-hidden='true'>&times;</span>";
            html+="</button></div>";

            $("#error").html(html);
        }
    });
}