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
                if(response.type == "success"){
                    swal({
                        title: response.title,
                        text: response.mensaje,
                        icon: response.type,
                    }).then((value) => {
                        var array = window.location.pathname.split( '/' );
                        array.pop();    
                        window.location.replace(window.location.origin + array.join("/"));
                    });
                }else if(response.type == "error"){
                    html="<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    $.each(response.mensaje , function(key, item){
                        html+="<p class='error-form-validation'>"+item+"</p>";
                    });
                    html+="<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    html+="<span aria-hidden='true'>&times;</span>";
                    html+="</button></div>";
                    
                    $("#error").html(html);
                }
            }
        });
    });
}
