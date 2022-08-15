$(document).ready(inicio);

const formulario = document.getElementById('formulario');

const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    curp: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/, //Validador de curp
    correo:  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ,
};

const campos = {
    curp: false,
    correo: false
};

const validarFormulario = (e) => {
    switch(e.target.name){
        case "curp":
            campos["password1"]=true;
            campos["password2"]=true;
            let curpMayus = e.target.value;
            e.target.value = "";
            e.target.value = curpMayus.toUpperCase().trim();
            validarCampo(expresiones.curp, e.target, 'curp');
        break;
        case "correo":
            validarCampo(expresiones.correo, e.target, 'correo');
        break;
    }
};

const validarCampo = (expresion, input, campo) => {
    if(expresion.test(input.value)){
        document.getElementById(`grupo_${campo}`).classList.remove('input-form-incorrecto');
        document.querySelector(`#grupo_${campo} .form-input-err`).classList.remove('form-input-err-activo');
        campos[campo] = true;
    }else{
        document.getElementById(`grupo_${campo}`).classList.add('input-form-incorrecto');
        document.querySelector(`#grupo_${campo} .form-input-err`).classList.add('form-input-err-activo');
        campos[campo] = false;
    }
};

inputs.forEach((input) => {
    input.addEventListener('blur', validarFormulario);
    input.addEventListener('keyup', validarFormulario);
});

formulario.addEventListener('submit', (e) =>{
    if(!campos.curp || !campos.correo){
        e.preventDefault();
        swal ( "Error" ,  "Corrige el formulario" ,  "error" );
    }
})

function inicio(){
    mostrarDatos("");
    $("#buscar").keyup(function(){
        buscar = $("#buscar").val();
        mostrarDatos(buscar);
    });
}

function mostrarDatos(valor){
    var base_url = window.location.origin + window.location.pathname;

    $.ajax({
        url: base_url+"/mostrar",
        type:"POST",
        data:{buscar:valor},
        success:function(respuesta){
            var registros = eval(respuesta);
            html = "<table class='table table-bordered'><thead class='thead-light'>";
            html += "<tr><th scope='col'>CURP</th><th scope='col'>Nombre</th><th scope='col'>Apellido paterno</th><th scope='col'>Apellido materno</th></tr>";
            html += "</thead><tbody>";
            for(var i = 0; i < registros.length; i++){
                html += "<tr><th scope='row'>"+registros[i]["curp"]+"</th><td>"+registros[i]["nombre"]+"</td><td>"+registros[i]["apellidoP"]+"</td><td>"+registros[i]["apellidoM"]+"</td></tr>"
            };
            html +="</tbody></table>";
            $("#listaUsuarios").html(html);
        }
    });
}

