$(document).ready(inicio);

function inicio(){
    $("#guardar").attr('disabled', 'disabled');
    document.getElementById("buscarActivo").onclick = function() {buscarActivo($("#noActivo").val().toUpperCase())}; 
    $("#formularioAsignacion").submit(function(ev){
        ev.preventDefault();
        guardarAsignacion();
    });
}

function buscarActivo(noActivo){
    document.getElementById('loaderB').classList.add('loader');
    $.ajax({
        url: "buscarActivo",
        type:"POST",
        data: {noActivo:noActivo},
        dataType:"json",
        success:function(respuesta){
            document.getElementById('loaderB').classList.remove('loader');
            $("#guardar").removeAttr("disabled");

            if(respuesta.type == "success"){
                activo = eval(respuesta.activo);
                $("#guardar").removeAttr("disabled");
                document.getElementById("marca").value = activo['marca'];
                document.getElementById("modelo").value = activo['modelo'];
            }else if(respuesta.type == "error"){
                $("#guardar").prop("disabled", true);
                document.getElementById("marca").value = "";
                document.getElementById("modelo").value = "";
                swal({
                    title: "Activo no encontrado",
                    icon: "error",
                    text: "¿Deseas registrar este activo?",
                    buttons: {
                        cancel: {
                            text: "No",
                            value: null,
                            visible: true,
                        },
                        confirm: {
                            text: "Si",
                            value: true,
                            visible: true,
                        }
                    },
                  })
                  .then((value) => {
                    if(value){
                        $activo = $('#noActivo').val();
                        window.location.replace(window.location.origin +  window.location.pathname + "/registar activo?idActivo="+ $activo);
                    }
                  });
            }else if(respuesta.type == "warning"){
                $("#guardar").prop("disabled", true);
                document.getElementById("marca").value = "";
                document.getElementById("modelo").value = "";
                swal({
                    title: "Atención",
                    icon: "warning",
                    text: "Este activo ya esta asignado, escoge otro",
                })
            }
        }
    });
}

function guardarAsignacion(){
    $('#loader').addClass('loader');
    var data = {
        'noActivo':$('#noActivo').val(),
        'usuarioAsignado':$('#idUsuario').val(),
        'observaciones':$('#observaciones').val().toUpperCase(),
    };
    $.ajax({
        url: "guardarAsignacion",
        type:"POST",
        data: data,
        dataType:"json",
        success:function(respuesta){
            $('#loader').removeClass('loader');
            if(respuesta.type == "success"){
                swal({
                    title: respuesta.title,
                    text: respuesta.mensaje,
                    icon: respuesta.type,
                }).then((value) => { 
                    var array = window.location.pathname.split( '/' );
                    array.pop();    
                    window.location.replace(window.location.origin + array.join("/"));
                });
            }
        }
    });
}