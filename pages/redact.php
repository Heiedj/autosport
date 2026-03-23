<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/pages.css">
    <link rel="stylesheet" href="/style/media.css">
    <title>Изменение товара</title>

</head>

<body>
    <!-- Шапка -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="login-user container">
            <h3>Изменение товара</h3>
            <?php
            $id = $_GET['id'];
            // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
            $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
            // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');

            $sql = "
                SELECT g.*, pi.image_path 
                FROM `goods` g
                LEFT JOIN `product_images` pi ON g.id = pi.product_id 
                WHERE g.id = $id
            ";

            $result = mysqli_query($link, $sql);
            if (!$result) {
                die('Ошибка SQL: ' . mysqli_error($link));
            }

            $product = mysqli_fetch_array($result);
            if (!$product) {
                die('Товар не найден.');
            }
            ?>
            <div class="form">
                <form action="/php/red.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <div class="item-input">
                        <input type="text" name="nameProduct" id="valid1" value="<?= $product['name_goods'] ?>">
                    </div>
                    <div class="item-input">
                        <textarea name="description" rows="5" style="box-sizing: border-box; width: 100%;" id="valid2"><?= $product['description'] ?></textarea>
                    </div>
                    <div class="item-input">
                        <input type="text" name="price" value="<?= $product['price_goods'] ?>" id="valid3" placeholder="Цена">
                    </div>
                    <?php
                    // Получаем все доступные цвета
                    $sqlColors = "SELECT id, name FROM color";
                    $resultColors = mysqli_query($link, $sqlColors);

                    // Получаем выбранные цвета для конкретного товара
                    $sqlSelectedColors = "SELECT id_color FROM goods_color WHERE id_goods = $id";
                    $resultSelectedColors = mysqli_query($link, $sqlSelectedColors);

                    // Сохраняем выбранные цвета в массив
                    $selectedColors = [];
                    while ($row = mysqli_fetch_array($resultSelectedColors)) {
                        $selectedColors[] = $row['id_color'];
                    }
                    ?>
                    <div class="select-card">
                        <div class="checkbox-block">
                            <?php while ($rowColor = mysqli_fetch_array($resultColors)): ?>
                                <div class="item-input checkbox-category">
                                    <label for="<?= $rowColor['id'] ?>"><?= $rowColor['name'] ?></label>
                                    <input type="checkbox" name="color[]" id="<?= $rowColor['id'] ?>" value="<?= $rowColor['id'] ?>"
                                        <?php if (in_array($rowColor['id'], $selectedColors)): ?>checked<?php endif; ?>>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <?php
                    // Получаем все размеры
                    $sqlSizes = "SELECT id, name FROM size";
                    $resultSizes = mysqli_query($link, $sqlSizes);

                    // Получаем выбранные размеры для конкретного товара
                    $sqlSelected = "SELECT id_size FROM goods_size WHERE id_goods = $id";
                    $resultSelected = mysqli_query($link, $sqlSelected);

                    // Сохраняем выбранные размеры в массив
                    $selectedSizes = [];
                    while ($row = mysqli_fetch_array($resultSelected)) {
                        $selectedSizes[] = $row['id_size'];
                    }
                    ?>
                    <div class="select-card">
                        <div class="checkbox-block">
                            <?php while ($rowSize = mysqli_fetch_array($resultSizes)): ?>
                                <div class="item-input checkbox-category">
                                    <label for="<?= $rowSize['id'] ?>"><?= $rowSize['name'] ?></label>
                                    <input type="checkbox" name="size[]" id="<?= $rowSize['id'] ?>" value="<?= $rowSize['id'] ?>"
                                        <?php if (in_array($rowSize['id'], $selectedSizes)): ?>checked<?php endif; ?>>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="item-input">
                        <input type="text" name="count" id="valid8" value="<?= $product['count_goods'] ?>">
                    </div>
                    <div class="product-images">
                        <ul>
                            <?php
                            // Получаем изображения товара
                            $sqlImages = "SELECT image_path FROM product_images WHERE product_id = $id";
                            $resultImages = mysqli_query($link, $sqlImages);
                            while ($image = mysqli_fetch_array($resultImages)): ?>
                                <li>
                                    <img src="/uploads/<?= $image['image_path'] ?>" alt="<?= $image['image_path'] ?>" width="100">
                                    <span class="delete-icon" onclick="deleteImage('<?= $image['image_path'] ?>')" title="Удалить">&times;</span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <div class="item-input img-input">
                        <label for="image">Выберите изображение:</label>
                        <input type="file" id="image" name="images[]" accept="image/*"  multiple>
                    </div>
                    <button type="submit">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </main>
    <!-- ------------- -->
    <!-- Подвал -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';
    ?>
    <!-- ------------- -->
    <script src="/js/login.js"></script>
    <script src="/js/script.js"></script>
    <script>
        function deleteImage(imageName) {
            if (confirm('Вы уверены, что хотите удалить это изображение?')) {
                fetch('/php/delete_image.php?name=' + encodeURIComponent(imageName), {
                        method: 'DELETE'
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload(); // Обновите страницу
                        } else {
                            alert('Ошибка при удалении изображения');
                        }
                    });
            }
        }
    </script>
</body>


</html>