<?php

// Der größte Wert in der Tabelle

function antwort($data, $i = 0) {
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $max = antwort($value, $i++);
            $antwort = $max;
        }
    elseif (is_int($value) && $max > $antwort) {
            $max = max($data);
        }
    }
    echo '<pre>';
    echo 'Array (Level: ' . $i . '): <br/>';
    var_export($data);
    echo 'antwort: <br/>';
    var_export($antwort);
    echo '</pre>';


    return $antwort;
}


echo 'Test 1 Array: ' . implode(', ', $a = array(3,5,6,8,9,15,62,21,0,-16,33)) . ' <br> soll: 33, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 Array: ' . implode(', ', $a = array(3,-3,-6,-8,-9,-15,-62,-21,-0,-16,-33)) . ' <br> soll: 3, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 Array: ' . implode(', ', $a = array(1,5,9,array(16,22),array(18,21),20)) . ' <br> soll: 22, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 Array: ' . implode(', ', $a = array(15,array(1,3,6,20,array(21,5,14,6)),array(array(array(17,13,array(60)),15),16),-10)) . ' <br> soll: 60, ist: ' . var_export(antwort($a), true) . '<br><br>';