<?php
session_start();

header('content-type: image/png');
$name = 'Name:';
$mark = 'Your mark:';
$rightAnswers = 'Number of the right answers:';
$font = "arial.ttf";
$img = imagecreatetruecolor ( 300, 200 );
$text_color = imagecolorallocate($img, 233, 14, 91);
imagestring($img, 2, 5, 5, $name . ' ' . $_SESSION['user'], $text_color);
imagestring($img, 2, 5, 25,$mark . ' ' . $_GET['mark'], $text_color);
imagestring($img, 2, 5, 45,$rightAnswers . ' ' . $_GET['summ'] . '/' . $_GET['a'], $text_color);
imagepng($img);
