<?php
$i=0;
$z=0;
$newString = [];
$csvName = 'books.csv';
$query=0;

if (!empty($argv[1])) {

    $query = urlencode($argv[1]);
    $path = "https://www.googleapis.com/books/v1/volumes?q={$query}";
    $file = file_get_contents($path, true);
    $json = json_decode($file,true);

    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo " - Ошибок нет \n";
            break;
        case JSON_ERROR_DEPTH:
            echo " - Достигнута максимальная глубина стека \n";
            break;
        case JSON_ERROR_STATE_MISMATCH:
            echo " - Некорректные разряды или несоответствие режимов \n";
            break;
        case JSON_ERROR_CTRL_CHAR:
            echo " - Некорректный управляющий символ \n";
            break;
        case JSON_ERROR_SYNTAX:
            echo " - Синтаксическая ошибка, некорректный JSON \n";
            break;
        case JSON_ERROR_UTF8:
            echo " - Некорректные символы UTF-8, возможно неверно закодирован \n";
            break;
        default:
            echo " - Неизвестная ошибка \n";
            break;
    }

    for ($i=0; $i<count($json); $i++) {

        $id = $json['items'][$z++]['id'];
        $title = $json['items'][$z]['volumeInfo']['title'];
        $author = $json['items'][$z]['volumeInfo']['authors'][0];
        $newString[] = [$id, $title, $author];

    }

} else {
    echo "Введите поисковый запрос \n";
}

$resource = fopen($csvName, 'a');


foreach ($newString as $string) {

    $addRow = fputcsv($resource, $string, ',');
}

fclose($resource);