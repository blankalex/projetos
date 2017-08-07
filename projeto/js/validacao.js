function valida_campo(id){
    var campo = document.getElementById(id);
    if (campo.value == ''){
        alert('campo ' + campo.title + ' deve ser preenchido');
        campo.focus();
    }
}