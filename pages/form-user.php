<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/media.css">
    <link rel="stylesheet" href="/style/pages.css">
    <title>Заявки пользователей</title>
</head>

<body>
    <!-- Шапка -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="container" style="margin-top: 50px;">
            <?php
            // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
            // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
            $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
            $sql = "SELECT *
                            FROM
                            individual
                        ";
            $result = mysqli_query($link, $sql);
            ?>
            <?php while($individual=mysqli_fetch_array($result)):?>
                <div class="order">
                    <p><?= $individual['name_user']?></p>
                    <p><?= $individual['tel']?></p>
                    <p><?= $individual['mess']?></p>
                </div>
            <?php endwhile; ?>
            <?php
            // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
            // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
            $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
            $sql = "SELECT *
                            FROM
                            questions
                        ";
            $result = mysqli_query($link, $sql);
            ?>
            <?php while($questions=mysqli_fetch_array($result)):?>
                <div class="order">
                    <p><?= $questions['tel']?></p>
                    <p><?= $questions['mess']?></p>
                </div>
            <?php endwhile; ?>
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