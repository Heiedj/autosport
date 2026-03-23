<?php
include "db.php";

// Получаем имя изображения из запроса
$image_name = isset($_GET['name']) ? $_GET['name'] : '';

if (!empty($image_name)) {
    // Удаляем изображение из базы данных
    $sql = "DELETE FROM `product_images` WHERE `image_path` = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("s", $image_name);

    if ($stmt->execute()) {
        // Удаляем файл с сервера
        $file_path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $image_name;
        if (file_exists($file_path)) {
            unlink($file_path); // Удаляем файл
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Не указано имя изображения']);
}

$mysql->close();
