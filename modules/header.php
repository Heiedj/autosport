<header>
    <nav class="navbar">
        <div class="header-top">
            <div class="container">
                <div class="top-left">
                    <a href="/">
                        <img src="/img/svg/logo.svg" alt="Логотип">
                    </a>
                    <p>Добро пожаловать в мир автоспорта!</p>
                </div>
                <div class="top-center">
                    <div class="text">
                        <a href="tel:+7(838)218-54-76">+7(838)218-54-76</a>
                        <span>Пн-Пт 10:00 - 21:00 Сб-Вс 11:00 - 21:00</span>
                    </div>
                    <div class="icon">
                        <a href="https://vk.com" target="_blank"><img src="/img/svg/vk.svg" alt="ВК"></a>
                        <a href="https://web.telegram.org" target="_blank"><img src="/img/svg/tg.svg" alt="Telegram"></a>
                    </div>
                </div>
                <div class="top-right">
                    <a href="/pages/basket.php"><img src="/img/svg/basket.svg" alt="Корзина"></a>
                    <?php if ($_COOKIE['id'] == ''): ?>
                        <a href="/pages/login.php"><img src="/img/svg/login.svg" alt="Вход"></a>
                    <?php else: ?>
                        <a href="/pages/account.php"><img src="/img/svg/login.svg" alt="Вход"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <ul>
                    <?php
                    // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                    // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                    $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                    $sql = "SELECT * FROM `kind`";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <li><a href="/pages/catalog.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
                    <?php endwhile; ?>

                </ul>
            </div>
        </div>
        <div class="burger">
            <a href="/">
                <img src="/img/svg/logo.svg" alt="Логотип">
            </a>
            <img src="/img/svg/menu.svg" alt="" onclick="toMenu()">
        </div>
        <div class="menu-burger">
            <div class="top-right">
                <a href="/pages/basket.php"><img src="/img/svg/basket.svg" alt="Корзина"></a>
                <?php if ($_COOKIE['id'] == ''): ?>
                    <a href="/pages/login.php"><img src="/img/svg/login.svg" alt="Вход"></a>
                <?php else: ?>
                    <a href="/pages/account.php"><img src="/img/svg/login.svg" alt="Вход"></a>
                <?php endif; ?>
            </div>
            <div class="menu-category">
                <ul>
                    <?php
                    // $link = mysqli_connect('localhost', 'is25pif1_fora', 'is25pif1_', 'is25pif1_fora');
                    // $link = mysqli_connect('localhost', 'root', 'root', 'forracing');
                    $link = mysqli_connect('localhost', 'cu80620_fora', 'fora', 'cu80620_fora');
                    $sql = "SELECT * FROM `kind`";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <li><a href="/pages/catalog.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
                    <?php endwhile; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>