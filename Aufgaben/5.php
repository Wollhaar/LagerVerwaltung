<?php

// Der größte Wert in der Tabelle

function antwort($data) {
    $max = null;
    foreach ($data as $val) {
        if (is_array($val)) $val = antwort($val);
        if ($val > $max) $max = $val;
    }
    return $max;
}


$a1 = array(3,5,6,8,9,15,62,21,0,-16,33);
$a2 = array(3,-3,-6,-8,-9,-15,-62,-21,-0,-16,-33);

$a3 = array(1,5,9,
    array(16,22),
    array(18,21),
    20);

$a4 = array(15,
    array(1,3,6,20,
        array(21,5,14,6)),
    array(
        array(
            array(17,13,
                array(60)
            ),
            15),
        16),
    -10);


echo 'Test 1 Array: ' . json_encode($a1) . ' <br> soll: 33, ist: ' . var_export(antwort($a1), true) . '<br><br>';
echo 'Test 2 Array: ' . json_encode($a2) . ' <br> soll: 3, ist: ' . var_export(antwort($a2), true) . '<br><br>';
echo 'Test 3 Array: ' . json_encode($a3) . ' <br> soll: 22, ist: ' . var_export(antwort($a3), true) . '<br><br>';
echo 'Test 4 Array: ' . json_encode($a4) . ' <br> soll: 60, ist: ' . var_export(antwort($a4), true) . '<br><br>';