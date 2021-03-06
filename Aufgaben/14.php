<?php

// Wieviel Minuten ist zwischen start und stop
const start = '26.03.2021 09:00:00';

function antwort($data) {
    $d1 = new DateTime(start);
    $d2 = new DateTime($data);
    $diff = date_diff($d1, $d2);
    print_r($diff);
    $min = 0;
    $min += ($diff->days * 24 * 60);
    $min += $diff->h * 60;
    $min += $diff->i;
    return $min;
}

echo 'Test 1 ' . ($stop = '26.03.2021 09:10:00') . ' <br> soll: 10, ist: ' . var_export(antwort($stop), true) . '<br><br>';
echo 'Test 2 ' . ($stop = '27.03.2021 09:00:00') . ' <br> soll: 1440, ist: ' . var_export(antwort($stop), true) . '<br><br>';
echo 'Test 3 ' . ($stop = '26.06.2021 09:00:00') . ' <br> soll: 132420, ist: ' . var_export(antwort($stop), true) . '<br><br>';
echo 'Test 4 ' . ($stop = '26.03.2022 09:00:00') . ' <br> soll: 525600, ist: ' . var_export(antwort($stop), true) . '<br><br>';
echo 'Test 5 ' . ($stop = '01.09.1988 12:45:00') . ' <br> soll: 17127195, ist: ' . var_export(antwort($stop), true) . '<br><br>';