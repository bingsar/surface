<?php
$csvName = 'data.csv';
$handle = fopen($csvName, 'r');
$csv = array_map('str_getcsv', file($csvName));
$shortest = -1;
print_r($csv);
if (isset($argv[1])) {
    $input = $argv[1];
    foreach ($csv as $word) {
        $lev = levenshtein($input, $word[1]);
        if ($lev == 0) {
            $closest = $word[1];
            $shortest = 0;
            break;
        }
        if ($lev <= $shortest || $shortest < 0) {
            $closest = $word[1];
            $shortest = $lev;
        }
    }
    if ($shortest == 0) {
        if ($word[1] == $argv[1]) {
            echo $closest . ': ' . $word[4];
        }
    } else {
        echo "Did you mean?: $closest\n";
    }
} else {
    echo 'Please type right country name';
}