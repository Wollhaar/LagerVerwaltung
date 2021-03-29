<?php
// Schreib alleine eine Funktion, die Array mit Zahlen sortiert.

function antwort($data, $i = 0)
{
    $sorted = true;
    foreach ($data as $key => $value) {
        if (key_exists($key + 1, $data) && $value > $data[$key + 1]) {
            array_push($data, $value);
            unset($data[$key]);
            $sorted = false;
        }
    }
    if (!$sorted) $data = antwort(array_values($data), ++$i);
    else $data['times'] = 'sorting took ' . $i . ' times';
    return $data;
}


echo 'Test 0 ' . json_encode($a = array(7,2,5,1,3)) . ' <br> soll: 1,2,3,5,7 ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 1 ' . json_encode($a = array(1, 6, 2, 5, 2, 6, 1, 2)) . ' <br> soll: 1,1,2,2,2,5,6,6, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . json_encode($a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 8)) . ' <br> soll: 1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,8,9,9,10,10,11,11, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . json_encode($a = array(1,1,1,1,2,3,5,4,1,-1,-2,-2,-2,2)) . ' <br> soll: -2,-2,-2,-1,1,1,1,1,1,2,2,3,4,5, ist: ' . var_export(antwort($a), true) . '<br><br>';
