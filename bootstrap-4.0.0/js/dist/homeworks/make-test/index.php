<?php
require_once 'functions.php';

$errors = [];
if (!empty($_POST)) {
    if (login($_POST['login'], $_POST['password'])) {
        header('Location: list.php');
        die;
    } else {
        $errors[] = 'Неверный логин или пароль';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>Авторизация</h1>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <form method="POST">
                        <div class="form-group">
                            <label for="lg" class="sr-only">Логин</label>
                            <input type="text" placeholder="Логин" name="login" id="lg" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Пароль</label>
                            <input type="password" placeholder="Пароль" name="password" id="key" class="form-control">
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Войти">
                    </form>
                    <h3>или Вы можете войти как гость</h3>
                    <form action="list.php" method="GET">
                        <div class="form-group">
                            <label for="lg" class="sr-only">Имя</label>
                            <input type="text" placeholder="Имя" name="name" id="lg" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name id="btn-login" class="btn btn-success btn-lg btn-block" value="Войти как гость">
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>