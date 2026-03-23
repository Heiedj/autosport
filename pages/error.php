<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/media.css">
    <link rel="stylesheet" href="/style/pages.css">
    <title>Интернет-магазин ForRacing</title>
</head>

<body>
    <!-- Шапка -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="good-order container" style="margin-bottom:50px;">
            <h3>Неправильный логин или пароль</h3>
            <a href="/pages/login.php" class="card-button buy">Еще раз</a>
        </div>
    </main>
    <!-- ------------- -->
    <!-- Подвал -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';
    ?>
    <!-- ------------- -->
    <script src="/js/script.js"></script>
    <script src="/js/slaider.js"></script>
</body>

</html>