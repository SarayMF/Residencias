$(document).ready(inicio);

function inicio(){
    $("#formularioActivo").submit(function(ev){
        document.getElementById('loader').classList.add('loader');
        ev.preventDefault();
        aplicaciones = [];
        $("input[type=checkbox]:checked").each(function(){
            aplicaciones.push($(this).val());
        });
        var data = {
            'marca':$('#marca').val(),
            'modelo':$('#modelo').val(),
            'memoriaRAM':$('#memoriaRAM').val(),
            'discoDuro':$('#discoDuro').val(),
            'procesador':$('#procesador').val(),
            'aplicaciones':JSON.stringify(aplicaciones),
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
