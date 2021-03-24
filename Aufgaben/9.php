<?php
// summe von a

function antwort($data)
{
    $antwort = 0;
    return $antwort;
}


echo 'Test 1 ' . ($a = array(array('a' => 10, 'b' => 5, 'c' => 20),
                             array('a' => 10, 'b' => 5, 'c' => 20),
                             array('a' => 10, 'b' => 5, 'c' => 20))) . ' <br> soll: 30, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' .  ($a = array(array('a' => 100, 'b' => 51, 'c' => 22),
        array('b' => 55, 'c' => 200),
        array('a' => -10, 'b' => 57, 'c' => 20))) . ' <br> soll: 90, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = array(array('a' => -100, 'b' => 51, 'c' => 22),
        array('a' => 55, 'c' => 200),
        array('a' => 77, 'b' => 57, 'c' => 20))) . ' <br> soll: 32, ist: ' . var_export(antwort($a), true) . '<br><br>';