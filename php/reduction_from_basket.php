<?php
session_start();

if (isset($_GET['key'])) {
    $unique_key = $_GET['key'];

    // Проверяем, существует ли товар в корзине
    if (isset($_SESSION['cart'][$unique_key])) {
        // Уменьшаем количество
        $_SESSION['cart'][$unique_key]['count']--;

        // Если количество стало 0, удаляем товар из корзины
        if ($_SESSION['cart'][$unique_key]['count'] <= 0) {
            unset($_SESSION['cart'][$unique_key]);
        }
    }
}

// Перенаправляем назад
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
