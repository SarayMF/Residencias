$(document).ready(inicio);

function inicio(){
    var select = new SlimSelect({
        select: '#listaAplicaciones'
    });
    listaAplicaciones = $('#apps').val();
    appArray = listaAplicaciones.split(',');
    select.set(appArray);
    $("#formularioActivo").submit(function(ev){
        document.getElementById('loader').classList.add('loader');
        ev.preventDefault();
        var data = {
            'idActivo':$('#idActivo').val(),
            'marca':$('#marca').val().toUpperCase(),
            'modelo':$('#modelo').val().toUpperCase(),
            'memoriaRAM':$('#memoriaRAM').val(),
            'discoDuro':$('#discoDuro').val(),
            'procesador':$('#procesador').val().toUpperCase(),
            'observaciones':$('#observaciones').val().toUpperCase(),
            'aplicaciones':JSON.stringify(select.selected()),
        };
        $.ajax({
            url: $('#idActivo').val(),
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
