<?php

// Du kriegst 2 zahlen, wie viele zahles zwischen die 2 Zahlen, lassen sich durch 2 oder 3 teilen?
// z.B. 1,6 hat folgende zahlen: 1,2,3,4,5, davon kann man 2,3,4,6 durch 2 oder 3 tailen, daher kommt 4 als Antwort.

function antwort($data) {
    $antwort = 0;
    for ($i = $data[0]; $i <= $data[1]; $i++) {
        if ($i%2 == 0 || $i%3 == 0) $antwort++;
    }
    return $antwort;
}


echo 'Test 1 ' . ($a = array(1,6)) . ' <br> soll: 4, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = array(0,30)) . ' <br> soll: 21, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = array(-20,20)) . ' <br> soll: 27, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = array(-100000000,100000000)) . ' <br> soll: 133333335, ist: ' . var_export(antwort($a), true) . '<br><br>';