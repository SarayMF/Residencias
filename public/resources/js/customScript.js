const formulario = document.getElementById('formulario');

const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    curp: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/, //Validador de curp
    correo:  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ,
    contraseña: /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[a-zA-Z!#$%&? "])[a-zA-Z0-9!#$%&?]{8,20}$/,
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


