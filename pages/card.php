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
        <div class="hit container card-pages">
    <?php
    $id = $_GET['id'];
    // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
    $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
    // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');

    $sql = "
        SELECT g.*, pi.image_path 
        FROM `goods` g
        LEFT JOIN `product_images` pi ON g.id = pi.product_id 
        WHERE g.id = $id
    ";

    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Ошибка SQL: ' . mysqli_error($link));
    }

    $product = mysqli_fetch_array($result);
    if (!$product) {
        die('Товар не найден.');
    }
    ?>
    <div class="text">
        <h3><?= $product['name_goods'] ?></h3>
    </div>
    <div class="card">
        <div class="img-card-container">
            <?php
            // Выводим первое изображение
            if ($product['image_path']) {
                echo "<img class='card-img' src='/uploads/{$product['image_path']}' alt='{$product['name_goods']}' onclick='toImg()'>";
            }

            // Выводим остальные изображения
            while ($row = mysqli_fetch_array($result)) {
                if ($row['image_path']) {
                    echo "<img class='card-img' src='/uploads/{$row['image_path']}' alt='{$product['name_goods']}' onclick='toImg()'>";
                }
            }
            ?>
        </div>
        <div class="footer-card">
            <form action="/php/add-to-cart.php" method="POST">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <input type="hidden" name="name" value="<?= $product['name_goods'] ?>">
    <input type="hidden" name="image" value="<?= $product['image_path'] ?>">
    <input type="hidden" name="price" value="<?= $product['price_goods'] ?>">
    <input type="hidden" name="count" value="<?= $product['count_goods'] ?>">
    
    <?php
    // Получаем цвета
    $sql = "SELECT color.name, color.id, goods_color.id_goods, goods_color.id_color
            FROM goods_color
            JOIN color ON goods_color.id_color = color.id
            WHERE goods_color.id_goods = $id";
    $resultColor = mysqli_query($link, $sql);
    ?>
    <label for="color">Цвет</label>
    <select name="color" id="color">
        <?php while ($rowColor = mysqli_fetch_array($resultColor)): ?>
            <option value="<?= $rowColor['id_color'] ?>"><?= $rowColor['name'] ?></option>
        <?php endwhile; ?>
    </select>
    
    <?php
    // Получаем размеры
    $sql = "SELECT size.name, size.id, goods_size.id_goods, goods_size.id_size
            FROM goods_size
            JOIN size ON goods_size.id_size = size.id
            WHERE goods_size.id_goods = $id";
    $resultSize = mysqli_query($link, $sql);
    ?>
    <label for="size">Размер</label>
    <select name="size" id="size">
        <?php while ($rowSize = mysqli_fetch_array($resultSize)): ?>
            <option value="<?= $rowSize['id_size'] ?>"><?= $rowSize['name'] ?></option>
        <?php endwhile; ?>
    </select>
    
    <p class="new-price"><?= $product['price_goods'] ?> руб.</p>
    <div class="block-button">
        <?php if($_COOKIE['role']==0):?>
        <a class="card-button buy" href="/pages/login.php">Купить</a>
        <?php else:?>
        <button class="card-button buy" type="submit">Купить</button>
        <?php endif;?>
    </div>
    <p class="description"><?= $product['description'] ?></p>
</form>

        </div>
    </div>
</div>

    </main>
    <!-- ------------- -->
    <!-- Подвал -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';
    ?>
    <!-- ------------- -->
    <script src="/js/script.js"></script>
    <script src="/js/accordeon.js"></script>
</body>

</html>