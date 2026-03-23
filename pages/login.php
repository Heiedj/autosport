<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/pages.css">
    <link rel="stylesheet" href="/style/media.css">
    <title>Интернет-магазин ForRacing</title>
    <!-- Теги для соцсетей -->
    <meta name="description" content="Интернет-магазин ForRacing предлагает широкий ассортимент атрибутики для автоспорта: одежда, аксессуары, запчасти и многое другое по выгодным ценам.">
    <meta name="keywords" content="ForRacing, интернет-магазин, автоспорт, атрибутика, одежда для гонок, аксессуары, запчасти">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://is25pif1.beget.tech/">
    <meta property="og:title" content="ForRacing - Интернет-магазин атрибутики для автоспорта">
    <meta property="og:description" content="Покупайте атрибутику для автоспорта в интернет-магазине ForRacing. Лучшие цены на одежду, аксессуары и запчасти!">
    <meta property="og:image" content="/img/svg/logo.svg">

</head>

<body>
    <!-- Шапка -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="login-user container">
            <h3>Вход</h3>
            <div class="form">
                <form action="/php/authorization.php" method="POST" id="auth" class="validation-form">
                    <div class="item-input">
                        <input type="email" name="email" id="valid1" placeholder="Почта" required oninput="validateEmail()">
                    </div>
                    <div class="item-input">
                        <input type="password" name="pass" id="valid2" placeholder="Пароль" required>
                    </div>
                    <button type="submit">Войти</button>
                    <span onclick="toReg()">Еще нет аккаунта</span>
                </form>
                <form action="/php/registration.php" method="POST" id="reg" class="none" class="validation-form">
                    <div class="item-input">
                        <input type="text" name="name" id="valid1" placeholder="Имя" required>
                    </div>
                    <div class="item-input">
                        <input type="email" name="email" id="valid2" placeholder="Почта" required oninput="validateEmail()">
                    </div>
                    <div class="item-input">
                        <input type="password" name="pass" id="valid3" placeholder="Пароль" required>
                    </div>
                     <div class="item-input checkbox-reg">
                        <label for="valid4">Нажимая кнопку "Регистрация”, Вы соглашаетесь с <a href="/pages/processing-policy.php">Политикой конфиденциальности</a></label>
                        <input type="checkbox"  id="valid4" required>
                    </div>
                    <button type="submit">Зарегистрироваться</button>
                    <span onclick="toReg()">Уже есть аккаунт</span>
                </form>
            </div>
        </div>
    </main>
    <!-- ------------- -->
    <!-- Подвал -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';
    ?>
    <!-- ------------- -->
    <script src="/js/login.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>