<?php
// получение данных
$name = filter_var(trim($_POST['name']));
$tel = filter_var(trim($_POST['tel']));
$mess = filter_var(trim($_POST['mess']));

//подключение к бд
include "db.php";
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}
//sql-запрос
if($_COOKIE['id'] === '0' || empty($_COOKIE['id'])){
    $result = $mysql->query("INSERT INTO `individual` (`id_user`, `name_user`, `tel`, `mess`) VALUES (10, '$name', '$tel', '$mess ')");
}else{
    $id_user = $_COOKIE['id'];
    $result = $mysql->query("INSERT INTO `individual` (`id_user`, `name_user`, `tel`, `mess`) VALUES ('$id_user', '$name', '$tel', '$mess ')");
}

//поверка
if (!$result) {
    die("Ошибка: " . $mysql->error);
};

//закрытие
$mysql->close();

//переадресация
header('Location: /pages/good-order.php')

?>