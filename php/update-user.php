<?php
$id = filter_var(trim($_POST['id']));
$name = filter_var(trim($_POST['name']));
$surname = filter_var(trim($_POST['surname']));
$patronymic = filter_var(trim($_POST['patronymic']));
$tel = filter_var(trim($_POST['tel']));
$email = filter_var(trim($_POST['email']));
$address = filter_var(trim($_POST['address']));
include "db.php";

// Проверяем соединение с базой данных
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Исправленный SQL-запрос
$result = $mysql->query("UPDATE `users` SET `name` = '$name', `surname` = '$surname', `patronymic` = '$patronymic', `tel` = '$tel', `email` = '$email', `address` = '$address' WHERE `id` = '$id'");
if (!$result) {
    die("Ошибка: " . $mysql->error);
}
$mysql->close();

header('Location: /pages/account.php');
?>
