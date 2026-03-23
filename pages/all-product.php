<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/pages.css">
    <link rel="stylesheet" href="/style/media.css">
    <title>Товары</title>
</head>

<body>
    <!-- Шапка -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
    ?>
    <!-- ------------- -->
    <!-- Контент -->
    <main>
        <div class="scroll">
            <table class="all-product container">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                //  $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                $sql = "SELECT * FROM goods";
                $result = mysqli_query($link, $sql);
                ?>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td>
                                <?= $row['name_goods'] ?>
                            </td>
                            <td>
                                <?= $row['description'] ?>
                            </td>
                            <td>
                                <?= $row['price_goods'] ?>
                            </td>
                            <td>
                                <?= $row['count_goods'] ?>
                            </td>
                            <td>
                                <a class="card-button buy" href="/pages/redact.php?id=<?= $row['id'] ?>">Изменить</a>
                            </td>
                            <td>
                                <a class="card-button buy" href="/php/delete.php?id=<?= $row['id'] ?>">Удалить</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <!-- ------------- -->
    <!-- Подвал -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';
    ?>
    <!-- ------------- -->
    <script src="/js/script.js"></script>
    <script src="/js/accordeon.js"></script>
</body>

</html>