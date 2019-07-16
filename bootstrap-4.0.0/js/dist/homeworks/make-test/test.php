<?php
require_once 'functions.php';

if (!isAuthorized() && empty($_GET)) {
    header('Location: index.php');
    die;
}


$x=0;
$y=1;
$main=0;

$summ=0;
$correct=[];

if (!empty($_GET)) {
    $q = $_GET['q'];
    $filename = 'tests' . DIRECTORY_SEPARATOR . $q;
    $get = file_get_contents($filename);
    if (!$get) {
        http_response_code(404);
        exit;
    }

    $json = json_decode($get, true) or exit('Can\'t decode');


}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
<form action="test.php" method="POST">

    <?php if (!empty($_GET)) { foreach ($json as $key => $info) { ?>

    <fieldset>

        <legend><?php echo $info['question']; ?></legend>
            <?php foreach ($info['answers'] as $ques) { $z = $z = $ques['q' . $y++]; ?>
                <label><input type="radio" name="<?php echo 'q' . $key; ?>" value="<?php echo $z; ?>" required><?php echo $z; ?></label><br>
            <?php } $x=0; $y=1; $z=1;?>
    </fieldset>
    <?php } ?>
        <label> <input type="hidden" value="<?=$q?>" name="test"></label>
        <input type="submit" value="Проверить результаты">
    <?php } ?>


</form>

<?php
$mark=0;
if (!empty($_POST)) {
$answ = [];
$answers = $_POST['test'];
$getAnswers = file_get_contents('tests' . DIRECTORY_SEPARATOR . $answers) or exit('Ne poluchaetsya');
$jsonAnswers = json_decode($getAnswers, true) or exit('Can\'t decode');

echo '<h3>' . 'Результаты:' . '</h3>';
$a=0;
foreach ($jsonAnswers as $countQues => $correct) {;

        if ($_POST['q' . $a++] == ($correct['correct'])) {
            $summ++;

    }
}
    if ($summ == 0 || $a/$summ > 5) {
        $mark = 2;
    }
elseif ($a/$summ == 1) {
        $mark = 5;
} elseif ($a/$summ > 1 && $a/$summ <= 2) {
        $mark = 4;
} elseif ($a/$summ > 2 && $a/$summ <= 5) {
        $mark = 3;
}

 echo '<br>';

echo '<img ' . 'src=' . "img.php?mark=$mark&summ=$summ&a=$a" . '>';
}

?>
<?php
if (isset($_SESSION['user']['username']) && $_SESSION['user']['username'] == 'Администратор') {
echo '<a href=' . 'admin.php' . '>' . 'Загрузить файлы' . '</a>' . '<br>';
}
?>
<hr>
<a href="list.php">Перейти к списку загруженных файлов</a>
<ul>
    <li><a class="btn btn-success" href="logout.php">Выход</a> </li>
</ul>
</body>
</html>
