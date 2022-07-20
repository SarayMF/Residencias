const formulario = document.getElementById('formulario');

const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    curp: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/, //Validador de curp
    correo:  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ 
}

const validarFormulario = (e) => {
    switch(e.target.name){
        case "curp":
            if(expresiones.curp.test(e.target.value)){
                document.getElementById('grupo_curp').classList.remove('input-form-incorrecto');
            }else{
                document.getElementById('grupo_curp').classList.add('input-form-incorrecto');
            }
        break;
        case "correo":
        break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
    
});