'use strict'
//кнопки
let button = document.querySelector('.block-button');
let buttons = Array.from(document.querySelectorAll('.count-button'));
//длина слайдера
let slaider = document.querySelector('.slaider').offsetWidth;
//счетчик слайдов
let countSlaid = 0;
let translate = 0;
//счетчик массива кнопок
let countArr = 1;
//счетчик автоматического слайдера
let count = 0;
//массив кнопок
let arr = [];
arr.push(document.querySelector('.click-but'));
//массив со слайдами
let slaid = Array.from(document.querySelectorAll('.slaid'));
//кол-во слайдов
let slaidLength = slaid.length;
//массив слайдов
let slaides = document.querySelector('.slaides');
setInterval(() => {
    count++;
    if(count>=slaidLength){
        translate = 0;
        count = 0;
        buttons[0].classList.add('click-but');
        arr.push(buttons[0]);
    }else{
        buttons[count].classList.add('click-but');
        arr.push(buttons[count]);
        countSlaid = count;
        translate = -slaider*countSlaid;
    }
    slaides.style.transform = `translate(${translate}px)`;
    if(arr.length > countArr){
        arr[0].classList.remove('click-but');
        arr.shift();
    }else{
        return
}
}, 5000);
button.addEventListener('click', slaidShow);
function slaidShow(event) {
    let clickElement = buttons.indexOf(event.target);
    if(!buttons[clickElement].classList.contains('click-but')){
        buttons[clickElement].classList.add('click-but');
        arr.push(buttons[clickElement]);
        count++;
        countSlaid = clickElement;
        translate = -slaider*countSlaid;
        slaides.style.transform = `translate(${translate}px)`;
        if(arr.length > countArr){
            arr[0].classList.remove('click-but');
            arr.shift();
        }else{
            return
        }
    }else{
        return
    }
    setInterval();
}


