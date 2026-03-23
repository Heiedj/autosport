<footer>
    <nav class="container">
        <div class="footer-top">
            <div class="logo">
                <a href="/"><img src="/img/svg/logo.svg" alt="Логотип"></a>
            </div>
        </div>
        <div class="footer-center">
            <ul>
                <p>Каталог товаров</p>
                <?php
                // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                $sql = "SELECT * FROM `kind`";
                $result = mysqli_query($link, $sql);
                ?>
                <?php while ($row = mysqli_fetch_array($result)): ?>
                    <li><a href="/pages/catalog.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
                <?php endwhile; ?>
            </ul>
            <ul>
                <p>Покупателям</p>
                <li><a href="/pages/loyalt-program.php">Программа лояльности</a></li>
                <li><a href="/pages/delivery.php">Способы доставки</a></li>
                <li><a href="/pages/payment.php">Способы оплаты</a></li>
                <li><a href="/pages/return.php">Возврат и обмен товара</a></li>
                <li><a href="/pages/questions-answers.php">Вопросы и ответы</a></li>
                <li><a href="/pages/return-money.php">Возврат денежных средств</a></li>
            </ul>
            <ul>
                <p>О магазине</p>
                <li><a href="/pages/about.php">О нас</a></li>
                <li><a href="/pages/contact.php">Контакты</a></li>
                <li><a href="/pages/blog.php">Блог</a></li>
            </ul>
            <div class="contact-footer">
                <a href="tel:+7(838)218-54-76">+7(838)218-54-76</a>
                <span>Будни: 10:00-21:00
                    <br>
                    Выходные и праздничные дни: 11:00-21:00</span>
                <address><a href="https://yandex.ru/maps/-/CHrsaHKL" target="_blank">ул. Тверская, 10с1, Москва, 125009</a></address>
                <div class="icon">
                    <a href="https://vk.com" target="_blank"><img src="/img/svg/vk.svg" alt="ВК"></a>
                    <a href="https://web.telegram.org" target="_blank"><img src="/img/svg/tg.svg" alt="Telegram"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <hr>
            <div class="text">
                <p>&copy; Создано в учебных целях 2025</p>
                <a href="/pages/processing-policy.php">Политика конфиденциальности</a>
                <a href="/pages/offer.php">Публичная оферта</a>
            </div>
        </div>
    </nav>
</footer>