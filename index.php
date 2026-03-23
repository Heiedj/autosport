<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/img/svg/favicon.svg" type="image/x-icon">
  <link rel="stylesheet" href="/style/style.css">
  <link rel="stylesheet" href="/style/media.css">
  <title>Интернет-магазин ForRacing</title>
  <!-- Теги для соцсетей -->
  <meta name="description" content="Интернет-магазин ForRacing предлагает широкий ассортимент атрибутики для автоспорта: одежда, аксессуары, запчасти и многое другое по выгодным ценам.">
  <meta name="keywords" content="ForRacing, интернет-магазин, автоспорт, атрибутика, одежда для гонок, аксессуары, запчасти">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://is25pif1.beget.tech/">
  <meta property="og:title" content="ForRacing - Интернет-магазин атрибутики для автоспорта">
  <meta property="og:description" content="Покупайте атрибутику для автоспорта в интернет-магазине ForRacing. Лучшие цены на одежду, аксессуары и запчасти!">
  <meta property="og:image" content="/img/svg/logo.svg">


</head>

<body>
  <!-- Шапка -->
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php';
  ?>
  <!-- ------------- -->
  <!-- Контент -->
  <main>
    <div class="slaider">
      <div class="slaidshow">
        <div class="slaides">
          <div class="slaid landing" id="slaidOne">
          </div>
          <div class="slaid landing" id="slaidTwo">
          </div>
          <div class="slaid landing" id="slaidThree">
          </div>
        </div>
      </div>
      <div class="button-slaider">
        <div class="block-button">
          <div class="count-button click-but"></div>
          <div class="count-button"></div>
          <div class="count-button"></div>
        </div>
      </div>
    </div>
    <div class="catalog-index">
      <div class="text container">
        <h3>Каталог</h3>
      </div>
      <div class="items container">
        <?php
        $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
        // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
        $sql = "SELECT * FROM `kind`";
        $result = mysqli_query($link, $sql);
        ?>
        <?php while ($row = mysqli_fetch_array($result)): ?>
          <a class="catalog-item <?= $row['en-name'] ?>-index-catalog" href="/pages/catalog.php?id=<?= $row['id'] ?>"><span><?= $row['name'] ?></span></a>
        <?php endwhile; ?>
      </div>
    </div>
    <div class="promo container">
      <h4>Комбинезон
        <br>
        по персональным меркам
      </h4>
      <div class="button-flex">
        <a href="#popup-style" style="border-radius: 5px;">ПОДРОБНЕЕ</a>
      </div>
    </div>
    <div class="hit container">
      <div class="text">
        <h3>Хиты продаж</h3>
      </div>

      <?php
      $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
      // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
      $sql = "SELECT g.*, MIN(pi.image_path) AS image_path
        FROM `goods` g
        LEFT JOIN `product_images` pi ON g.id = pi.product_id
        GROUP BY g.id
        ORDER BY g.id DESC
        LIMIT 4";
      $result = mysqli_query($link, $sql);
      ?>
      <div class="catalog-card">
        <?php
        $count = 0;
        while ($row = mysqli_fetch_array($result)):
          if ($count >= 4) break;
          $count++;
        ?>
          <div class="card">
            <div class="img-card-container">
              <img class="card-img" src="/uploads/<?= $row['image_path'] ?>" alt="<?= $row['name_goods'] ?>">
            </div>
            <p class="name-card"><?= $row['name_goods'] ?></p>
            <div class="footer-card">
              <p class="new-price"><?= $row['price_goods'] ?>руб.</p>
              <div class="block-button">
                <a class="card-button buy" href="/pages/card.php?id=<?= $row['id'] ?>">Выбрать</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>


    </div>
    </div>
    <div class="form-question">
      <div class="form-content container">
        <div class="text">
          <h3>Не нашли что искали?</h3>
        </div>
        <form action="/php/question.php" method="POST" class="validation-form">
          <input type="tel" id="phone" name="tel" placeholder="Ваш номер телефона" required>
          <textarea name="mess" placeholder="Сообщение" rows="5" required></textarea>
          <div class="block-button">
            <button type="submit">Отправить</button>
          </div>
        </form>
      </div>
    </div>
    <?php
    if ($_COOKIE['role'] != ''):
    ?>
    <?php
    $id_user = $_COOKIE['id'];
    $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
    // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
    // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
    $sql = "SELECT * FROM `users` WHERE `id` = '$id_user'";
    $result = mysqli_query($link, $sql);
    ?>
    <?php while($form_ind = mysqli_fetch_array($result)):?>
    <div id="popup-style" class="popup">
      <a href="#" class="popup_area"></a>
      <div class="popup-body">
        <div class="popup-content">
          <a href="#" class="popup-close"><img src="/img/svg/close.svg" alt="Закрыть"></a>
          <div class="popup-title">
            <p>Напишите нам ваши пожелания, и мы с вами свяжемся</p>
          </div>
          <div class="popup-text">
            <form action="/php/add-individual.php" method="POST" class="validation-form">
              <input type="text" name="name" placeholder="Ваше имя" value="<?= $form_ind['name']?>" required>
              <input type="tel" name="tel" placeholder="Ваш номер телефона" value="<?= $form_ind['tel']?>" required>
              <textarea name="mess" placeholder="Сообщение" rows="5" required></textarea>
              <div class="block-button">
                <button type="submit">Отправить</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
    <?php else:?>
    <div id="popup-style" class="popup">
      <a href="#" class="popup_area"></a>
      <div class="popup-body">
        <div class="popup-content">
          <a href="#" class="popup-close"><img src="/img/svg/close.svg" alt="Закрыть"></a>
          <div class="popup-title">
            <p>Напишите нам ваши пожелания, и мы с вами свяжемся</p>
          </div>
          <div class="popup-text">
            <form action="/php/add-individual.php" method="POST" class="validation-form">
              <input type="text" name="name" placeholder="Ваше имя" required>
              <input type="tel" name="tel" id="phone" placeholder="Ваш номер телефона" required>
              <textarea name="mess" placeholder="Сообщение" rows="5" required></textarea>
              <div class="block-button">
                <button type="submit">Отправить</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </main>
  <!-- ------------- -->
  <!-- Подвал -->
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';
  ?>
  <!-- ------------- -->
  <script src="/js/script.js"></script>
  <script src="/js/slaider.js"></script>
</body>

</html>