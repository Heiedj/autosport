<?php
session_start();
// Ссылка на обратную страницу
$back = $_SERVER['HTTP_REFERER'];

// Если корзины нет, она создается
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Если корзина получает запрос на добавление товара
if (isset($_POST['id'])) {
    $product_id = $_POST['id'];
    
    // Получаем информацию о товаре из базы данных
    // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
    $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
    // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
    
    if (!$link) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }
    
    // Запрос для получения информации о товаре и его первом изображении
    $sql = "
        SELECT g.*, pi.image_path 
        FROM goods g
        LEFT JOIN product_images pi ON g.id = pi.product_id 
        WHERE g.id = $product_id
        LIMIT 1
    ";
    
    $result = mysqli_query($link, $sql);
    
    if (!$result) {
        die("Ошибка выполнения запроса: " . mysqli_error($link));
    }

    $product = mysqli_fetch_array($result);

    // Проверяем, существует ли товар
    if ($product) {
        // Получаем название цвета и размера
        $color_id = isset($_POST['color']) ? $_POST['color'] : null;
        $size_id = isset($_POST['size']) ? $_POST['size'] : null;

        // Получаем название цвета
        $color_sql = "SELECT name FROM color WHERE id = $color_id";
        $color_result = mysqli_query($link, $color_sql);
        $color_name = mysqli_fetch_assoc($color_result)['name'];

        // Получаем название размера
        $size_sql = "SELECT name FROM size WHERE id = $size_id";
        $size_result = mysqli_query($link, $size_sql);
        $size_name = mysqli_fetch_assoc($size_result)['name'];

        // Создаем уникальный ключ для товара с учетом цвета и размера
        $unique_key = $product_id . '-' . $color_id . '-' . $size_id;

        // Если товар уже в корзине, увеличиваем количество
        if (isset($_SESSION['cart'][$unique_key])) {
            $_SESSION['cart'][$unique_key]['count']++;
        } else {
            // Если товара нет в корзине, добавляем его
            $_SESSION['cart'][$unique_key] = array(
                'id' => $product['id'],
                'name' => $product['name_goods'],
                'price' => $product['price_goods'],
                'image' => $product['image_path'], // Получаем путь к первому изображению
                'count' => 1,
                'color' => $color_name, // Сохраняем название цвета
                'size' => $size_name // Сохраняем название размера
            );
        }
    } else {
        echo "Товар с ID $product_id не найден.";
    }
}

// Если пришел запрос на удаление товара из корзины
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];

    // Проверяем, существует ли товар в корзине
    if (isset($_SESSION['cart'][$product_id])) {
        // Удаляем товар из корзины
        unset($_SESSION['cart'][$product_id]);
        // Можно добавить сообщение об успешном удалении
        echo "Товар с ID $product_id был удален из корзины.";
    } else {
        // Сообщение о том, что товар не найден в корзине
        echo "Товар с ID $product_id не найден в корзине.";
    }
}

// Перенаправляем обратно
header("Location: $back");
exit();
