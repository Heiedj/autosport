<?php
session_start();
include_once "db.php";

// Получаем ID пользователя из куки
$user = $_COOKIE['id']; // Измените 'user_id' на 'id', если это необходимо

// Получаем номер телефона и адрес из POST-запроса
$user_tel = isset($_POST['tel']) ? $_POST['tel'] : ''; // Убедитесь, что номер телефона передан
$user_address = isset($_POST['address']) ? $_POST['address'] : ''; // Убедитесь, что адрес передан

// Проверяем, есть ли товары в корзине
if (!empty($_SESSION['cart'])) {
    // Генерация уникального номера заказа (например, с использованием текущей метки времени)
    $order_number = time(); // Можно использовать более сложный алгоритм, если необходимо

    foreach ($_SESSION['cart'] as $unique_key => $product) {
        $product_count = $product['count'];
        $product_name = $product['name'];
        $image = $product['image'];
        $price = $product['price'];
        $product_color = $product['color']; // Получаем цвет товара
        $product_size = $product['size']; // Получаем размер товара

        // Вставка заказа с уникальным номером заказа
        $insert_result = $mysql->query("INSERT INTO `orders` (`user_id`, `user_tel`, `address`, `product_id`, `order_products`, `order_count`, `order_price`, `order_color`, `order_size`, `status`) VALUES ('$user', '$user_tel', '$user_address', '$order_number', '$product_name', '$product_count', '$price', '$product_color', '$product_size', 1)");

        if (!$insert_result) {
            // Обработка ошибки при вставке
            echo "Ошибка при создании заказа: " . $mysql->error;
            exit();
        }
    }

    // Очистка корзины после успешного создания заказа
    unset($_SESSION['cart']);
    
    // Перенаправление на страницу корзины с уведомлением о заказе
    header('Location: /pages/good-order.php');
    exit();
} else {
    echo "Корзина пуста!";
}
?>
