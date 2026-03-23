<?php
// получение данных
$tel = filter_var(trim($_POST['tel']));
$mess = filter_var(trim($_POST['mess']));

//подключение к бд
include "db.php";
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}
//sql-запрос
    $result = $mysql->query("INSERT INTO `questions` (`tel`, `mess`) VALUES ('$tel', '$mess ')");

//поверка
if (!$result) {
    die("Ошибка: " . $mysql->error);
};

//закрытие
$mysql->close();

//переадресация
header('Location: /pages/good-order.php')

?>