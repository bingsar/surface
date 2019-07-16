<html>

<?php
$filename = 'data.json';

$get = file_get_contents($filename) or exit('Ne poluchaetsya');

$json = json_decode($get,true) or exit('Can\'t decode');
echo '<pre>';
print_r($json);

?>
</html>
