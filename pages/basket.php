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
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/php/db.php';

    // $order_result = $_GET['order'];
    // if ($order_result == 'yes') {
    //     unset($_SESSION['cart']);
    // }
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="cart container">
            <div class="text">
                <h3>Корзина</h3>
            </div>
            <?php if (empty($_SESSION['cart'])) : ?>
                <p class='none-card'>В корзине нет товаров</p>
            <?php else : ?>
                <div class="scroll">
                    <table class="all-product container">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Картинка</th>
                                <th>Цвет</th>
                                <th>Размер</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Общая сумма</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                        $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                        // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                        $sql = "SELECT * FROM goods";
                        $result = mysqli_query($link, $sql);
                        ?>
                        <tbody>
                            <?php
                            $total_sum = 0; // Переменная для хранения общей суммы
                            foreach ($_SESSION['cart'] as $unique_key => $products) :
                                $product_price = $products['price'] * $products['count'];
                                $total_sum += $product_price; // Добавляем стоимость товара к общей сумме
                            ?>
                                <tr>
                                    <td>
                                        <?= $products['name'] ?>
                                    </td>
                                    <td>
                                        <img src="/uploads/<?= $products['image'] ?>" alt="img" style='height: 150px;'>
                                    </td>
                                    <td>
                                        <?= $products['color'] ?>
                                    </td>
                                    <td>
                                        <?= $products['size'] ?>
                                    </td>
                                    <td>
                                        <?= $products['price'] ?>
                                    </td>
                                    <td>
                                        <div class="count-input">
                                            <a href="/php/reduction_from_basket.php?key=<?= $unique_key ?>">
                                                -
                                            </a> <?= $products['count'] ?>
                                            <a href="/php/add_more_in_basket.php?key=<?= $unique_key ?>">
                                                +
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $product_price ?>
                                    </td>
                                    <td>
                                        <a class="card-button buy" href="/php/add-to-cart.php?remove=<?= $unique_key ?>">Удалить</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">Общая сумма:</td>
                                <td><?= $total_sum ?></td>
                                <input type="hidden" name="price" id="valid1" type="hidden" value="<?= $total_sum ?>">
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    <?php
                    $id_users = $_COOKIE['id'];
                    // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                    $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                    // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                    $sql = "SELECT * FROM users WHERE id = '$id_users'";
                    $result = mysqli_query($link, $sql);
                    ?>
                        <form action="/php/order.php" method="POST" class="validation-form">
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <div class="item-input">
                            <input type="text" name="address" id="valid1" placeholder="Адрес" value="<?= $row['address'] ?>" required>
                        </div>
                        <div class="item-input">
                            <input type="tel" name="tel" id="phone" id="valid1" placeholder="Телефон" value="<?= $row['tel'] ?>" required>
                        </div>
                    <?php endwhile; ?>
                    <button type="submit">Оформить</button>
                </form>
            <?php endif; ?>
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