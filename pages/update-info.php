<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/pages.css">
    <link rel="stylesheet" href="/style/media.css">
    <title>Изменение данных</title>

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
            <h3>Изменение данных</h3>
            <?php
            $id = $_GET['id'];
            // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
            $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
            // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
            $sql = "SELECT * FROM `users` WHERE `id` = $id";
            $result = mysqli_query($link, $sql);
            ?>
            <div class="form">
                <form action="/php/update-user.php" method="POST" class="validation-form">
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <input name="id" value="<?= $row['id'] ?>" type="hidden">
                    <div class="item-input">
                        <input type="text" name="name" id="valid1" placeholder="Имя" value="<?= $row['name'] ?>">
                    </div>
                    <div class="item-input">
                        <input type="text" name="surname" id="valid1" placeholder="Фамилия" value="<?= $row['surname'] ?>">
                    </div>
                    <div class="item-input">
                        <input type="text" name="patronymic" id="valid1" placeholder="Отчество" value="<?= $row['patronymic'] ?>">
                    </div>
                    <div class="item-input">
                        <input type="tel" name="tel" id="phone" id="valid1" placeholder="Телефон" value="<?= $row['tel'] ?>">
                    </div>
                    <div class="item-input">
                        <input type="email" name="email" id="valid2" placeholder="Почта" value="<?= $row['email'] ?>">
                    </div>
                    <div class="item-input">
                        <input type="text" name="address" id="valid2" placeholder="Адрес" value="<?= $row['address'] ?>">
                    </div>
                    <?php endwhile; ?>
                    <button type="submit">Сохранить</button>
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