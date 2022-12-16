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
            if(response.type == "error"){
                html= "<div class='alert alert-"+response.div+" alert-dismissible fade show' role='alert'>";
                html+="   <p class='error-form-validation'>"+response.msg+"</p>";
                html+="   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                html+="   <span aria-hidden='true'>&times;</span>";
                html+="   </button></div>";
                $("#alerta").html(html);
            }else if(response.type == "success"){
                location.reload();
            }
        }
    });
}