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
        <div class="hit container">
            <div class="text">
                <h3>Каталог</h3>
            </div>
            <div class="catalog">
                <div class="filter">
                    <form action="" method="GET">
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : ''; ?>">
                        <?php
                        // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                        $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                        // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                        if (!$link) {
                            die("Ошибка подключения: " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM `category`";
                        $result = mysqli_query($link, $sql);
                        ?>
                        <?php while ($row = mysqli_fetch_array($result)): ?>
                            <div class="item-filter">
                                <label for="<?= $row['name'] ?>"><?= $row['name'] ?></label>
                                <input type="checkbox" name="filter[]" value="<?= $row['id'] ?>" id="<?= $row['name'] ?>">
                            </div>
                        <?php endwhile; ?>
                        <button type="submit">Поиск</button>
                    </form>
                </div>
                <div class="catalog-card">
                    <?php
                    // Получение id страницы
                    $id_pages = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    $filters = isset($_GET['filter']) ? $_GET['filter'] : [];

                    // Проверка на валидность id
                    if ($id_pages > 0) {
                        // Формирование SQL-запроса
                        $filterCondition = '';
                        if (!empty($filters)) {
                            $filterCondition = " AND `category_goods` IN (" . implode(',', array_map('intval', $filters)) . ")";
                        }

                        $sql = "SELECT g.id, g.name_goods, g.price_goods, MIN(pi.image_path) AS image_path 
        FROM `goods` g
        LEFT JOIN `product_images` pi ON g.id = pi.product_id
        WHERE `kind_goods` = '$id_pages' $filterCondition
        GROUP BY g.id, g.name_goods, g.price_goods
        ORDER BY g.id";

                        $result = mysqli_query($link, $sql);

                        // Проверка на наличие ошибок в запросе
                        if (!$result) {
                            echo "Ошибка выполнения запроса: " . mysqli_error($link);
                        } elseif (mysqli_num_rows($result) == 0) {
                            echo "<p class='none-card'>Нет товаров, соответствующих вашим фильтрам.</p>";
                        } else {
                            while ($row = mysqli_fetch_array($result)):
                    ?>
                                <div class="card">
                                    <div class="img-card-container">
                                        <img class="card-img" src="/uploads/<?= $row['image_path'] ?>" alt="<?= $row['name_goods'] ?>">
                                    </div>
                                    <p class="name-card"><?= $row['name_goods'] ?></p>
                                    <div class="footer-card">
                                        <p class="new-price"><?= $row['price_goods'] ?> руб.</p>
                                        <div class="block-button">
                                            <a class="card-button buy" href="/pages/card.php?id=<?= $row['id'] ?>">Выбрать</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                    <?php
                        }
                    } else {
                        echo "<p>Некорректный ID категории.</p>";
                    }

                    // Закрытие соединения с базой данных
                    mysqli_close($link);
                    ?>
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
    <script src="/js/slaider.js"></script>
</body>

</html>