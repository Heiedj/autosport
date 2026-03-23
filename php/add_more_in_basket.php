<?php
session_start();

if (isset($_GET['key'])) {
    $unique_key = $_GET['key'];

    // Проверяем, существует ли товар в корзине
    if (isset($_SESSION['cart'][$unique_key])) {
        // Увеличиваем количество
        $_SESSION['cart'][$unique_key]['count']++;
    }
}

// Перенаправляем назад
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
