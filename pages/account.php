<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/pages.css">
    <link rel="stylesheet" href="/style/media.css">
    <title>Личный кабинет</title>
</head>

<body>
    <!-- Шапка -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="container" style="margin-bottom: 50px;">
            <div class="text-account">
                <h3>Добро пожаловать, <?php echo $_COOKIE['name'] ?>!</h3>
            </div>
            <div class="block-function-account">
                <?php if ($_COOKIE['role'] == 2): ?>
                    <!-- Пользователь -->
                    <div class="block-data user-data">
                        <?php
                        $id_user = $_COOKIE['id'];
                        // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                        $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                        // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                        $sql = "SELECT * FROM `users` WHERE `id` = $id_user";
                        $result = mysqli_query($link, $sql);
                        ?>
                        <h4>Личные данные</h4>
                        <?php while ($row = mysqli_fetch_array($result)): ?>
                            <ul>
                                <li><b>ФИО:</b> <?= $row['name'] ?> <?= $row['surname'] ?> <?= $row['patronymic'] ?></li>
                                <li><b>Телефон: </b> <?= $row['tel'] ?></li>
                                <li><b>Почта: </b><?= $row['email'] ?></li>
                                <li><b>Адрес: </b><?= $row['address'] ?></li>
                            </ul>
                            <a class="button" href="/pages/update-info.php?id=<?= $row['id'] ?>">Изменить</a>
                            </div>
                        <?php endwhile; ?>
                        <?php
                        $user_id = $_COOKIE['id'];
                        $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                     $sql = "SELECT
                            orders.product_id,
                            orders.user_id,
                            orders.user_tel,
                            orders.address,
                            orders.order_products,
                            orders.order_count,
                            orders.order_price,
                            orders.order_color,
                            orders.order_size,
                            orders.status,
                            status_order.name_status, 
                            users.name,
                            users.id
                            FROM
                            orders
                            JOIN
                            users ON orders.user_id = users.id
                            JOIN
                            status_order ON orders.status = status_order.id
                            WHERE users.id = '$user_id';
                        ";
                        $result = mysqli_query($link, $sql);
                        ?>
                        <?php
                        // Предполагается, что $result - это результат вашего запроса к базе данных
                        $orders = []; // Массив для хранения заказов

                        while ($order_users = mysqli_fetch_array($result)) {
                            $product_id = $order_users['product_id'];
                            $order_products = $order_users['order_products'];
                            $order_count = $order_users['order_count'];
                            $order_price = $order_users['order_price'];
                            $order_color = $order_users['order_color'];
                            $order_size = $order_users['order_size'];
                            $name = $order_users['name'];
                            $tel = $order_users['user_tel'];
                            $address = $order_users['address'];
                            $order_status = $order_users['name_status']; // Добавляем статус заказа

                            // Если заказ еще не добавлен в массив, создаем новую запись
                            if (!isset($orders[$product_id])) {
                                $orders[$product_id] = [
                                    'product_id' => $product_id,
                                    'order_products' => [],
                                    'order_count' => 0,
                                    'order_price' => 0,
                                    'order_color' => [],
                                    'order_size' => [],
                                    'name' => $name,
                                    'tel' => $tel,
                                    'address' => $address,
                                    'order_status' => $order_status // Добавляем статус заказа
                                ];
                            }

                            // Добавляем товар в соответствующий заказ
                            $orders[$product_id]['order_products'][] = $order_products;
                            $orders[$product_id]['order_count'] += $order_count;
                            $orders[$product_id]['order_price'] += $order_count * $order_price;
                            $orders[$product_id]['order_color'][] = $order_color;
                            $orders[$product_id]['order_size'][] = $order_size;
                        }

                        // Теперь выводим заказы
                        foreach ($orders as $order) {
                            echo '<div class="order">';
                            echo '<div class="id-order">';
                            echo '<p>' . $order['product_id'] . '</p>';
                            echo '</div>';
                            echo '<div class="data-order">';

                            // Выводим все товары для данного заказа
                            for ($i = 0; $i < count($order['order_products']); $i++) {
                                echo '<p>' . $order['order_products'][$i] . ' - Цвет: ' . $order['order_color'][$i] . ', Размер: ' . $order['order_size'][$i] . '</p>';
                            }

                            echo '<p>Количество: ' . $order['order_count'] . '</p>';
                            echo '<p>Сумма: ' . $order['order_price'] . '</p>';
                            echo '<p>Имя: ' . $order['name'] . '</p>';
                            echo '<p>Телефон: ' . $order['tel'] . '</p>';
                            echo '<p>Адрес: ' . $order['address'] . '</p>';
                            echo '<p>Статус заказа: ' . $order['order_status'] . '</p>'; // Выводим статус заказа
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                <?php else: ?>
                    <!-- Админ -->
                    <a class="button" style="margin-bottom: 50px;" href="/pages/add-card.php">Добавить товар</a>
                    <a class="button" style="margin-bottom: 50px; margin-left: 50px;" href="/pages/all-product.php">Посмотреть товары</a>
                    <a class="button" style="margin-bottom: 50px; margin-left: 50px;" href="/pages/form-user.php">Обратная связь</a>
                    <div class="orders">
                        <?php
                        $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                     $sql = "SELECT
                            orders.product_id,
                            orders.user_id,
                            orders.user_tel,
                            orders.address,
                            orders.order_products,
                            orders.order_count,
                            orders.order_price,
                            orders.order_color,
                            orders.order_size,
                            orders.status,
                            status_order.name_status, 
                            users.name,
                            users.id
                            FROM
                            orders
                            JOIN
                            users ON orders.user_id = users.id
                            JOIN
                            status_order ON orders.status = status_order.id
                        ";
                        $result = mysqli_query($link, $sql);
                        ?>
                        <?php
                        // Предполагается, что $result - это результат вашего запроса к базе данных
                        $orders = []; // Массив для хранения заказов

                        while ($order_users = mysqli_fetch_array($result)) {
                            $product_id = $order_users['product_id'];
                            $order_products = $order_users['order_products'];
                            $order_count = $order_users['order_count'];
                            $order_price = $order_users['order_price'];
                            $order_color = $order_users['order_color'];
                            $order_size = $order_users['order_size'];
                            $name = $order_users['name'];
                            $tel = $order_users['user_tel'];
                            $address = $order_users['address'];
                            $order_status = $order_users['name_status']; // Добавляем статус заказа

                            // Если заказ еще не добавлен в массив, создаем новую запись
                            if (!isset($orders[$product_id])) {
                                $orders[$product_id] = [
                                    'product_id' => $product_id,
                                    'order_products' => [],
                                    'order_count' => 0,
                                    'order_price' => 0,
                                    'order_color' => [],
                                    'order_size' => [],
                                    'name' => $name,
                                    'tel' => $tel,
                                    'address' => $address,
                                    'order_status' => $order_status // Добавляем статус заказа
                                ];
                            }

                            // Добавляем товар в соответствующий заказ
                            $orders[$product_id]['order_products'][] = $order_products;
                            $orders[$product_id]['order_count'] += $order_count;
                            $orders[$product_id]['order_price'] += $order_count * $order_price;
                            $orders[$product_id]['order_color'][] = $order_color;
                            $orders[$product_id]['order_size'][] = $order_size;
                        }

                        // Теперь выводим заказы
                        foreach ($orders as $order) {
                            echo '<div class="order">';
                            echo '<div class="id-order">';
                            echo '<p>' . $order['product_id'] . '</p>';
                            echo '</div>';
                            echo '<div class="data-order">';

                            // Выводим все товары для данного заказа
                            for ($i = 0; $i < count($order['order_products']); $i++) {
                                echo '<p>' . $order['order_products'][$i] . ' - Цвет: ' . $order['order_color'][$i] . ', Размер: ' . $order['order_size'][$i] . '</p>';
                            }

                            echo '<p>Количество: ' . $order['order_count'] . '</p>';
                            echo '<p>Сумма: ' . $order['order_price'] . '</p>';
                            echo '<p>Имя: ' . $order['name'] . '</p>';
                            echo '<p>Телефон: ' . $order['tel'] . '</p>';
                            echo '<p>Адрес: ' . $order['address'] . '</p>';
                            echo '<p>Статус заказа: ' . $order['order_status'] . '</p>'; // Выводим статус заказа
                            echo '</div>';
                            echo '<div class="function-order">';
                            echo '<a class="button" href="/php/edite-status.php?id=1&order='.$order['product_id'].'">Новый</a>';
                            echo '<a class="button" href="/php/edite-status.php?id=2&order='.$order['product_id'].'">В работе</a>';
                            echo '<a class="button" href="/php/edite-status.php?id=3&order='.$order['product_id'].'">Доставка</a>';
                            echo '<a class="button" href="/php/edite-status.php?id=4&order='.$order['product_id'].'">Выполнен</a>';
                            echo '<a class="button" href="/php/edite-status.php?id=5&order='.$order['product_id'].'">Отменен</a>';
                             echo '<a class="button" href="/php/delete-order.php?id=5&order='.$order['product_id'].'">Удалить</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>



                    </div>
                <?php endif; ?>
            </div>
            <a class="button" href="/php/exit.php">Выход</a>
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