$(document).ready(inicio);

function inicio(){
    $("#guardar").attr('disabled', 'disabled');
    document.getElementById("buscar").onclick = function() {buscarUsuario($("#curp").val().toUpperCase())}; 
    $("#formularioAsignacion").submit(function(ev){
        ev.preventDefault();
        guardarAsignacion();
    });
}

function buscarUsuario(curp){
    document.getElementById('loader').classList.add('loader');
    $.ajax({
        url: "buscarUsuario",
        type:"POST",
        data: {curp:curp},
        dataType:"json",
        success:function(respuesta){
            document.getElementById('loader').classList.remove('loader');
            $("#guardar").removeAttr("disabled");

            if(respuesta.type == "success"){
                usuario = eval(respuesta.usuario);
                $("#guardar").removeAttr("disabled");
                document.getElementById("idUsuario").value = usuario['idUsuario'];
                document.getElementById("nombre").value = usuario['nombre'];
                document.getElementById("apellidoP").value = usuario['apellidoP'];
                document.getElementById("apellidoM").value = usuario['apellidoM'];
            }else if(respuesta.type == "error"){
                $("#guardar").prop("disabled", true);
                document.getElementById("idUsuario").value = "";
                document.getElementById("nombre").value = "";
                document.getElementById("apellidoP").value = "";
                document.getElementById("apellidoM").value = "";
            }
            
        }
    });
}

function guardarAsignacion(){
    var data = {
        'noActivo':$('#noActivo').val(),
        'usuarioAsignado':$('#idUsuario').val(),
        'observaciones':$('#observaciones').val().toUpperCase(),
    };
    $.ajax({
        url: $('idActivo').val(),
        type:"POST",
        data: data,
        dataType:"json",
        success:function(respuesta){
            if(respuesta.type == "success"){
                swal({
                    title: respuesta.title,
                    text: respuesta.mensaje,
                    icon: respuesta.type,
                }).then((value) => {  
                    var array = window.location.pathname.split( '/' );
                    array.pop();    
                    array.pop();
                    window.location.replace(window.location.origin + array.join("/"));
                });
            }
        }
    });
}