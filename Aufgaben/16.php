<?php
// Schreib alleine eine Funktion, die Array mit Zahlen sortiert - Ohne Rekusion - nur mit while Schleife.

function antwort($data)
{
    while ($data) {

    }
    return '';
}


echo 'Test 1 ' . json_encode($a = array(1, 6, 2, 5, 2, 6, 1, 2)) . ' <br> soll: 1,1,2,2,2,5,6,6, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . json_encode($a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 8)) . ' <br> soll: 1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,8,9,9,10,10,11,11, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . json_encode($a = array(1,1,1,1,2,3,5,4,1,-1,-2,-2,-2,2)) . ' <br> soll: -2,-2,-2,-1,1,1,1,1,1,2,2,3,4,5, ist: ' . var_export(antwort($a), true) . '<br><br>';