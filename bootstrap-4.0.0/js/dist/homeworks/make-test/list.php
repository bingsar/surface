<?php
require_once 'functions.php';

if (!isAuthorized() && empty(guest())) {
header('Location: index.php');
    die;
}

$list = glob('tests/*.json');
$i=0;

if (!empty($_POST)) {
    foreach ($_POST as $forDelete) {
        $path = 'tests\\' . $forDelete;
        unlink($path);
        header("Refresh:0");
    }
}
?>

<!doctype html>
<html lang="en">
<head>

<meta charset="UTF-8">
             <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                         <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>Список файлов</title>
</head>
<body>

<br><b>The list of uploaded files:</b><br><br>

<form action="list.php" method="POST">
    <?php if (isset($_SESSION['user']['username']) && $_SESSION['user']['username'] == 'Администратор') {?>
<?php foreach($list as $files) { $text = 'test.php' . '?q=' . substr($files,6); ?>

<input type="checkbox" id="<?=$i++?>" name="<?=$i?>" value="<?=substr($files,6)?>"><label for="<?=$i?>"><?php echo $i . ')' . '<a ' . 'href=' . "$text" . '>' . substr($files,6) . '</a>' . '<br>'; ?></label>
<?php } ?>
<br>
<input type="submit" value="Удалить выбранные файлы">
</form>
<?php } else { ?>
<?php foreach($list as $files) { $text = 'test.php' . '?q=' . substr($files,6); ?>
<?php $i++; echo $i . ')' . '<a ' . 'href=' . "$text" . '>' . substr($files,6) . '</a>' . '<br>'; }?>
<?php } ?>
<br><hr>

<?php
if (isset($_SESSION['user']['username']) && $_SESSION['user']['username'] == 'Администратор') {
    echo '<a href=' . 'admin.php' . '>' . 'Загрузить файлы' . '</a>' . '<br>';
    echo 'Добро пожаловать, ' . $_SESSION['user']['username'];
} else {
    echo 'Вы вошли как гость' .'<br>';
    echo 'Добро пожаловать, ' . $_SESSION['user'];
    jsonAddName();
}
?>

<ul>
    <li><a class="btn btn-success" href="logout.php">Выход</a> </li>
</ul>

</body>
</html>