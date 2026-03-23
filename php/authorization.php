<?php
// получение данных
$email = filter_var(trim($_POST['email']));
$pass = md5(filter_var(trim($_POST['pass'])));

//подключение к бд
include "db.php";
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}
//sql-запрос
$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");

//поверка
if (!$result) {
    die("Ошибка: " . $mysql->error);
};
$user = $result->fetch_assoc();
if (!$user){
    die(header('Location: /pages/error.php'));
}
setcookie('id', $user['id'], time() + 3600, '/');
setcookie('name', $user['name'], time() + 3600, '/');
setcookie('role', $user['role'], time() + 3600, '/');
//закрытие
$mysql->close();

//переадресация
header('Location: /pages/account.php')

?>