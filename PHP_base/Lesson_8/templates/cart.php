<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="cart">
                <a class="come_back" href="../public/index.php"><i class="fas fa-arrow-left"></i></a>

                <!--Проверяем залогинен пользователь или нет-->
                <?php echo (!$user_id = $_SESSION['users']) ?
                    //Если нет, показываем ссылку на страницу авторизации.
                    "<a class='enter' href='../public/login.php'>Войти</a>" :
                    //Если да - приветствуем!
                    "<div class='enter'>Привет, {$login}!<br><a class='account' href='../public/orders.php'>Заказы</a> | 
                                                            <a class='exit' href='../public/exit.php'>Выйти</a></div>" ?>

                <a href="cart.php"><img src="../public/img/main/cart.png" alt="cart"></a>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Корзина</h1>
        <!--Проверяем наличие товаров в корзине-->
        <?php if ($_SESSION['cart']): ?>
            <!--Если есть - обходим в цикле массив с товарами корзины-->
            <?php foreach ($arrProd as $product => $value): ?>
                <!--И если это не последний элемент массива-->
                <?php if ($product < count($arrProd) - 1): ?>
                <div class="item_wrapper">
                    <!--Выводим номер строки и вставляем остальные данные в шаблон-->
                    <span><?= $product + 1 ?></span>
                    <div class="cart_img">
                        <a href="../public/product.php?id=<?= $value['id'] ?>">
                            <img width="150px" src="../public/img/min/<?= $value['url'] ?>" alt="cart_img">
                        </a>
                    </div>
                    <div class="cart_item">
                        <a href="../public/product.php?id=<?= $value['id'] ?>">
                            <?= $value['title'] ?>
                        </a>
                        <div><?= $value['quantity'] ?> шт</div>
                        <div class="cart_item__price"><?= $value['cost'] ?> руб</div>
                        <!--$_SERVER['REQUEST_URI'] содержит имя скрипта, начиная от корневой директории
                        виртуального хоста и параметры. Используем для переадресации страницы на саму себя-->
                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                            <input type="hidden" name="cart_id" value="<?= $value['id'] ?>">
                            <input class="delete_btn" name="delete" type="submit" value="x">
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="total_count">
                <form action="../public/orders.php" method="post">
                    <input class="add_order" name="add_order" type="submit" value="Оформить заказ">
                </form>
                <span>Итого: <?php echo (!$value['total']) ? 0 : $value['total'] ?> руб.</span>
            </div>
        <?php else: ?>
        <div class="empty_cart_wrapper">
            <img src="../public/img/main/cart_black.png" alt="cart">
            <p class="empty_cart">Корзина пуста.<br>
                <span>Но это можно исправить;)</span>
            </p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>