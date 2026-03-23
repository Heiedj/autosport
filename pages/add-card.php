<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/pages.css">
    <link rel="stylesheet" href="/style/media.css">
    <title>Добавление товара</title>

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
            <h3>Добавление нового товара</h3>
            <div class="form">
                <form action="/php/upload.php" method="POST" enctype="multipart/form-data">
                    <div class="item-input">
                        <input type="text" name="nameProduct" id="valid1" placeholder="Название товара">
                    </div>
                    <div class="item-input">
                        <textarea name="description" placeholder="Описание" rows="5" style="box-sizing: border-box; width: 100%;" id="valid2"></textarea>
                    </div>
                    <div class="item-input">
                        <input type="text" name="price" id="valid3" placeholder="Цена">
                    </div>
                    <div class="checkbox-block">
                        <div class="item-input checkbox-category">
                            <label for="white">Белый</label>
                            <input type="checkbox" name="color[]" id="white" value="1">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="black">Черный</label>
                            <input type="checkbox" name="color[]" id="black" value="2">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="blue">Синий</label>
                            <input type="checkbox" name="color[]" id="blue" value="3">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="red">Красный</label>
                            <input type="checkbox" name="color[]" id="red" value="4">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="yellow">Желтый</label>
                            <input type="checkbox" name="color[]" id="yellow" value="5">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="green">Зеленый</label>
                            <input type="checkbox" name="color[]" id="green" value="6">
                        </div>
                    </div>
                    <div class="checkbox-block">
                        <div class="item-input checkbox-category">
                            <label for="S">S</label>
                            <input type="checkbox" name="size[]" id="S" value="1">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="M">M</label>
                            <input type="checkbox" name="size[]" id="M" value="2">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="L">L</label>
                            <input type="checkbox" name="size[]" id="L" value="3">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="XL">XL</label>
                            <input type="checkbox" name="size[]" id="XL" value="4">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="2XL">2XL</label>
                            <input type="checkbox" name="size[]" id="2XL" value="5">
                        </div>
                        <div class="item-input checkbox-category">
                            <label for="3XL">3XL</label>
                            <input type="checkbox" name="size[]" id="3XL" value="6">
                        </div>
                    </div>
                    <div class="item-input select-card">
                        <label for="valid6">Категория</label>
                        <select name="category_goods" id="valid6">
                            <option value="1">Комбинезоны</option>
                            <option value="2">Обувь</option>
                            <option value="3">Перчатки</option>
                            <option value="4">Шлемы</option>
                            <option value="5">Нижняя одежда</option>
                            <option value="6">Защита</option>
                            <option value="7">Головные уборы</option>
                            <option value="8">Худи</option>
                            <option value="9">Брелки</option>
                            <option value="10">Наклейки</option>
                        </select>
                    </div>
                    <div class="item-input select-card">
                        <label for="valid7">Вид</label>
                        <select name="kind_goods" id="valid7">
                            <option value="1">Автоспорт</option>
                            <option value="2">Картинг</option>
                            <option value="3">Life Style</option>
                        </select>
                    </div>
                    <div class="item-input">
                        <input type="text" name="count" id="valid8" placeholder="Количество">
                    </div>
                    <div class="item-input img-input">
                        <label for="image">Выберите изображение:</label>
                        <input type="file" id="image" name="images[]" accept="image/*" required multiple>
                    </div>
                    <button type="submit">Добавить</button>
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
</body>

</html>