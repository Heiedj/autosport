<?php

$id = $_GET['id'];

include('db.php');

$mysql->query("DELETE FROM goods WHERE id = '$id'"); 
$mysql->query("DELETE FROM goods_color WHERE id_goods = '$id'"); 
$mysql->query("DELETE FROM goods_size WHERE id_goods = '$id'"); 
$mysql->query("DELETE FROM product_images WHERE product_id = '$id'"); 

$mysql->close();

header('Location: /pages/all-product.php');


?>