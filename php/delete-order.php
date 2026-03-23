<?php

$id = $_GET['order'];
echo $id;
include('db.php');

$mysql->query("DELETE FROM orders WHERE product_id = '$id'"); 


$mysql->close();

header('Location: /pages/account.php');


?>