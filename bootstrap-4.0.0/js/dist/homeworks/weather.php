<html>
<head>

    <title>Погода в Москве</title>
    <?php
    $link = 'http://api.openweathermap.org/data/2.5/weather';
    $apiKey = 'f3d4855cbacbc20a8845e49073b854df';
    $city = 'Moscow';
    $units = 'metric';
    $apiURL = "{$link}?q={$city}&units={$units}&appid={$apiKey}";
    $get = file_get_contents($apiURL);
    $json = json_decode($get,true);
    function checkData($data) { if (empty($data)) { return 'не удалось получить данные'; }
        return $data;
    }
    ?>


</head>
<body>
<h1>Погода в Москве</h1>
<p>Температура: <?= checkData($json['main']['temp']);?> </p>
<p>Осадки: <?= checkData($json['weather'][0]['main']);?> </p>
</body>
</html>