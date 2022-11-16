$(document).ready(inicio);

function inicio(){
    $('#buscar').click(function(){buscarUsuario();});
    $('#curp').blur(function(){buscarUsuario();});
    registrar();
}

function registrar(){
    $("#formulario").submit(function(ev){
        document.getElementById('loader').classList.add('loader');
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
                document.getElementById('loader').classList.remove('loader');
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

function buscarUsuario(){
    curp = $('#curp').val(); 
    $('#loader').addClass('loader');
    $.ajax({
        url: 'buscar',
        type: 'POST',
        data: {curp:curp},
        dataType:"json",
        success: function(response){
            $('#loader').removeClass('loader');
            if(response.status == "success"){
                $('#nombre').val(response.nombre);
                $('#apellidoP').val(response.apellidoP);
                $('#apellidoM').val(response.apellidoM);
            }else{
                $('#nombre').val("");
                $('#apellidoP').val("");
                $('#apellidoM').val("");
            }
        }
    });
}