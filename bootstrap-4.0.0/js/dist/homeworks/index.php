<?php

$continents = [
    'South america' => ['Choloepus hoffmanni sdasdasd', 'Cingulataf', 'Panthera onca'],
    'North america' => ['Bison', 'Canis latrans', 'Grizzly bear'],
    'Africa' => ['Elapidae', 'Pythonidae', 'Bubalus bubalis'],
    'Eurasian' => ['Alces alces', 'Gulo gulo', 'Tamias'],
    'Australia' => ['Ornithorhynchus anatinus', 'Tachyglossidae', 'Macropus rufus']
];

$twoWordsMassive=[];

foreach ($continents as $key=>$continent) {
    foreach ($continent as $animals) {
        echo '<pre>';
        $twoWords = strpos($animals, ' ');
        if ($twoWords == true) {
            $twoWordsMassive[] =[$key => $animals];
        }
    }
}
//print_r($twoWordsMassive);

foreach ($twoWordsMassive as $keys => $value) {
    foreach ($value as $cont=>$values) {
    $oneWordMassive[] = [$cont => explode(' ', $values)];
        }
}
//print_r($oneWordMassive);
foreach ($oneWordMassive as $arrayKey => $wordsMass) {

    foreach ($wordsMass as $wordKey => $word) {


            $firstWords[] = [$wordKey => $word[0]];
            $secondWords[] = $word[1];

        }
    }



shuffle($firstWords);
shuffle($secondWords);

//var_dump($firstWords);
//var_dump($secondWords);
echo 'North America' . '<br>';

for ($i=0;$i<count($firstWords); $i++) {
        echo $firstWords[$i]['North america'];
    }


?>