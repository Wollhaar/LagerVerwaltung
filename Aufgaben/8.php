<?php
// Welche Zahl sich am meistens Wiederholt

function antwort($data)
{
    $antwort = array();
    foreach ($data as $value) {
        if (empty($antwort[$value])) $antwort[$value] = 0;
        $antwort[$value]++;
    }
    return array_search(max($antwort), $antwort);
}


echo 'Test 1 ' . ($a = array(1, 6, 2, 5, 2, 6, 1, 2)) . ' <br> soll: 2, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 8)) . ' <br> soll: 8, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = array(1,1,1,1,2,3,5,4,1,-1,-2,-2,-2,2)) . ' <br> soll: 1, ist: ' . var_export(antwort($a), true) . '<br><br>';