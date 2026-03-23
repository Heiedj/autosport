<?php
include "db.php";
setcookie('id', $user['id'], time() - 3600, '/');
setcookie('name', $user['name'], time() - 3600, '/');
setcookie('role', $user['role'], time() - 3600, '/');
//закрытие
$mysql->close();

//переадресация
header('Location: /')

?>