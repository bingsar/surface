<?php

$fontSize = 12;

if (!empty($_POST['font_size'])) {
    $fontSize = (int) $_POST['font_size'];
    setcookie('font_size', $fontSize, time() + 10);
}


if (!empty($_COOKIE['font_size'])) {
    $fontSize = $_COOKIE['font_size'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<form method="POST">
    <label for="font_size"> Размер шрифта </label>
    <input type="number" name="font_size" id="font_size"/>
    <button type="submit">Применить</button>
</form>

<p style="font-size: <?= $fontSize ?>px">Супер Текст</p>
</body>
</html>



