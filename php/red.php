<?php
include "db.php";

// Проверяем соединение с базой данных
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Получаем ID товара для изменения
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;

// Получаем данные из формы
$name = isset($_POST['nameProduct']) ? $_POST['nameProduct'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : 0;
$color = isset($_POST['color']) ? $_POST['color'] : [];
$size = isset($_POST['size']) ? $_POST['size'] : [];
$count = isset($_POST['count']) ? $_POST['count'] : 0;
$images = isset($_FILES['images']) ? $_FILES['images'] : [];

// Обновляем информацию о товаре в базе данных
$sql = "UPDATE `goods` SET `name_goods` = ?, `price_goods` = ?, `count_goods` = ?, `description` = ? WHERE `id` = ?";
$stmt = $mysql->prepare($sql);
$stmt->bind_param("siisi", $name, $price, $count, $description, $product_id);

if ($stmt->execute()) {
    // Обновление цветов
    $sql_color_delete = "DELETE FROM `goods_color` WHERE `id_goods` = ?";
    $stmt_color_delete = $mysql->prepare($sql_color_delete);
    $stmt_color_delete->bind_param("i", $product_id);
    $stmt_color_delete->execute();

    if (!empty($color)) {
        foreach ($color as $color_id) {
            $sql_color = "INSERT INTO `goods_color` (`id_goods`, `id_color`) VALUES (?, ?)";
            $stmt_color = $mysql->prepare($sql_color);
            $stmt_color->bind_param("ii", $product_id, $color_id);
            $stmt_color->execute();
        }
    }

    // Обновление размеров
    $sql_size_delete = "DELETE FROM `goods_size` WHERE `id_goods` = ?";
    $stmt_size_delete = $mysql->prepare($sql_size_delete);
    $stmt_size_delete->bind_param("i", $product_id);
    $stmt_size_delete->execute();

    if (!empty($size)) {
        foreach ($size as $size_id) {
            $sql_size = "INSERT INTO `goods_size` (`id_goods`, `id_size`) VALUES (?, ?)";
            $stmt_size = $mysql->prepare($sql_size);
            $stmt_size->bind_param("ii", $product_id, $size_id);
            $stmt_size->execute();
        }
    }

    // Обработка загрузки изображений
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_file_size = 2 * 1024 * 1024; // 2 MB

    if (!empty($images['name'][0]) && $images['error'][0] === UPLOAD_ERR_OK) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        // Проверяем, существует ли папка uploads и есть ли к ней доступ
        if (!is_dir($target_dir) || !is_writable($target_dir)) {
            die("Ошибка: папка uploads не существует или нет доступа к ней.");
        }

        foreach ($images['name'] as $key => $image) {
            if ($images['error'][$key] === UPLOAD_ERR_OK) {
                $file_type = $images['type'][$key];
                if (!in_array($file_type, $allowed_types)) {
                    echo "Неподдерживаемый тип файла: $image. Разрешены только JPEG, PNG и GIF.";
                    continue;
                }

                if ($images['size'][$key] > $max_file_size) {
                    echo "Размер файла $image превышает допустимый лимит в 2 МБ.";
                    continue;
                }

                $target_file = $target_dir . basename($image);
                if (move_uploaded_file($images['tmp_name'][$key], $target_file)) {
                    // Сохраняем информацию о изображении в базе данных
                    $sql_image = "INSERT INTO `product_images` (`product_id`, `image_path`) VALUES (?, ?)";
                    $stmt_image = $mysql->prepare($sql_image);
                    $stmt_image->bind_param("is", $product_id, $image);
                    $stmt_image->execute();
                } else {
                    echo "Ошибка при перемещении загруженного файла: " . error_get_last()['message'];
                }
            }
        }
    }

    header("Location: /");
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$mysql->close();
