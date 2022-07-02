<?php
session_start();

require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/funcs.php';

if (isset($_POST['btn_reg'])) {
    registration();
    header("Location: index.php");
    die;
}

if (isset($_POST['btn_log'])) {
    authorization();
    header("Location: index.php");
    die;
}

if (isset($_POST['btn_msg'])) {
    save_message();
    header("Location: index.php");
    die;
}

if (isset($_GET['do']) && $_GET['do'] == 'exit') {
    if (!empty($_SESSION['user'])) {
        unset($_SESSION['user']);
        header("Location: index.php");
        die;
    }
    unset($_SESSION['user']);
    header("Location: index.php");
    die;
}

$messages = get_messages();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Guestbook</title>
</head>

<body>
    <div class="main">
        <?php if (!empty($_SESSION['errors'])) : ?>
            <div class="alert error">
                <p class="any-msg">
                    <?php
                    echo $_SESSION['errors'];
                    unset($_SESSION['errors']);
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])) : ?>
            <div class="alert success">
                <p class="any-msg">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if (empty($_SESSION['user']['login'])) : ?>
            <!-- ФОРМА РЕГИСТРАЦИИ -->
            <form class="form-reg user-form" action="index.php" method="post">
                <h2 class="form-name">Регистрация</h2>
                <input class="form-input" type="text" name="login" placeholder="Имя">
                <input class="form-input" type="password" name="password" placeholder="Пароль">
                <button class="btn" type="submit" name="btn_reg">Зарегистрироваться</button>
            </form>
            <!-- ФОРМА АВТОРИЗАЦИИ -->
            <form class="form-log user-form" action="index.php" method="post">
                <h2 class="form-name">Авторизация</h2>
                <input class="form-input" type="text" name="login" placeholder="Имя">
                <input class="form-input" type="password" name="password" placeholder="Пароль">
                <button class="btn" type="submit" name="btn_log">Авторизоваться</button>
            </form>
        <?php else : ?>
            <section class="user-profile">
                <div class="greetings">
                    <p class="any-msg">Добро пожаловать, <?php echo htmlspecialchars($_SESSION['user']['login'], ENT_HTML5); ?>! <a class="link" href="?do=exit">Выйти</a></p>
                </div>
                <!-- ФОРМА ОТПРАВКИ СООБЩЕНИЯ -->
                <form class="form-msg user-form" action="index.php" method="post">
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Сообщение"></textarea>
                    <button class="btn" type="submit" name="btn_msg">Отправить</button>
                </form>
                <?php if (!empty($messages)) : ?>
                    <?php foreach ($messages as $message) : ?>
                        <div class="author-content">
                            <hr>
                            <div class="content">
                                <h3><?php echo htmlspecialchars($message['name']); ?></h3>
                                <p><?php echo htmlspecialchars($message['message']); ?></p>
                                <p>Дата: <?php echo $message['created_at']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </div>
</body>

</html>