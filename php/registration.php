<?php
// получение данных
$name = filter_var(trim($_POST['name']));
$email = filter_var(trim($_POST['email']));
$pass = md5(filter_var(trim($_POST['pass'])));

//подключение к бд
include "db.php";
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}
//sql-запрос
$result = $mysql->query("INSERT INTO `users` (`name`, `surname`, `patronymic`, `tel`, `email`, `pass`, `address`, `role`) VALUES ('$name', '', '', '', '$email', '$pass', '', 2)");

//поверка
if (!$result) {
    die("Ошибка: " . $mysql->error);
};

//закрытие
$mysql->close();

//переадресация
header('Location: /pages/login.php')

?>