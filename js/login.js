'use strict'
function toReg() {
    let formAuth = document.getElementById('auth');
    let formReg = document.getElementById('reg');
    if(formAuth.classList.contains('none')){
        formAuth.classList.remove('none');
        formReg.classList.add('none');
    }else if(formReg.classList.contains('none')){
        formAuth.classList.add('none');
        formReg.classList.remove('none');
    }
}