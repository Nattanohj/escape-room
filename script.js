function validarFormulario(){

    let respuesta = document.getElementById("respuesta").value;

    if(respuesta.trim() === ""){
        alert("Debes ingresar una respuesta.")
        return false;
    }

    return true;
}