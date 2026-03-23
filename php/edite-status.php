<?php
$status = $_GET['id'];
$id_product = $_GET['order'];
include "db.php";

// Проверяем соединение с базой данных
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Исправленный SQL-запрос
$result = $mysql->query("UPDATE `orders` SET `status` = '$status' WHERE `product_id` = '$id_product'");
if (!$result) {
    die("Ошибка: " . $mysql->error);
}
$mysql->close();

header('Location: /pages/account.php');
?>
