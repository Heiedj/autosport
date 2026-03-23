"use strict";
//зум
function adjustZoom() {
  var viewportWidth = window.innerWidth;
  var bodyWidth = 1440; // Ширина вашего body в пикселях
  var largeScreenThreshold = 1600; // Пороговое значение для определения больших экранов

  if (viewportWidth > largeScreenThreshold) {
      var zoomLevel = (viewportWidth / bodyWidth) * 100;
      document.body.style.zoom = zoomLevel + '%';
  } else {
      document.body.style.zoom = '100%';
  }
}

// Вызываем функцию для установки начального масштаба
adjustZoom();

// Слушаем изменения размеров окна браузера и обновляем масштаб при необходимости
window.addEventListener('resize', adjustZoom);
//---------------------------------------------------------------------------

function toMenu() {
  let menu = document.querySelector(".menu-burger");
  if (menu.classList.contains("active")) {
    menu.classList.remove("active");
  } else {
    menu.classList.add("active");
  }
}

function validateEmail() {
  const emailInput = document.getElementById("email");
  const errorMessage = document.getElementById("error");
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (!emailPattern.test(emailInput.value)) {
    errorMessage.textContent = "Некорректный адрес электронной почты";
  } else {
    errorMessage.textContent = "";
  }
}

document.querySelectorAll(".validation-form").forEach((form) => {
  form.addEventListener("submit", function (event) {
    let valid = true;

    // Сброс всех сообщений об ошибках
    form.querySelectorAll(".error").forEach(function (error) {
      error.textContent = "";
    });

    // Проверка всех полей ввода и текстовых областей
    form.querySelectorAll("input, textarea").forEach((input) => {
      const name = input.name;
      const value = input.value;

      // Проверка на обязательные поля
      if (input.hasAttribute("required") && !value.trim()) {
        form.querySelector(
          `.error[data-error-for="${name}"]`
        ).textContent = `${name} обязательно.`;
        valid = false;
      }

      // Проверка на корректность email
      if (input.type === "email" && value) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
          form.querySelector(`.error[data-error-for="${name}"]`).textContent =
            "Некорректный адрес электронной почты.";
          valid = false;
        }
      }

      // Проверка длины сообщения в текстовой области
      if (input.tagName === "TEXTAREA" && value.length < 10) {
        form.querySelector(`.error[data-error-for="${name}"]`).textContent =
          "Сообщение должно содержать не менее 10 символов.";
        valid = false;
      }

      // Дополнительная проверка для телефонного номера
      if (input.type === "tel" && value && !/^\+?\d{10,15}$/.test(value)) {
        form.querySelector(`.error[data-error-for="${name}"]`).textContent =
          "Некорректный номер телефона.";
        valid = false;
      }
    });

    // Если есть ошибки, предотвращаем отправку формы
    if (!valid) {
      event.preventDefault();
    }
  });
});

const phoneInput = document.getElementById("phone");

phoneInput.addEventListener("input", function (e) {
  // Удаляем все нецифровые символы
  let value = this.value.replace(/\D/g, "");

  // Форматируем номер телефона
  let formattedValue = "+7 ";
  if (value.length > 1) {
    formattedValue += "(" + value.substring(1, 4);
  }
  if (value.length >= 4) {
    formattedValue += ") " + value.substring(4, 7);
  }
  if (value.length >= 7) {
    formattedValue += "-" + value.substring(7, 9);
  }
  if (value.length >= 9) {
    formattedValue += "-" + value.substring(9, 11);
  }

  this.value = formattedValue;
});
