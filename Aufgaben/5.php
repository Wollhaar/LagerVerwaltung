<?php

// Amgrößte Wert in der Tabelle

function antwort($data) {
    $antwort = false;
    // Hier schreibst Du Deine Lösung

    return $antwort;
}


echo 'Test 1 ' . ($a = array(3,5,6,8,9,15,62,21,0,-16,33)) . ' <br> soll: 33, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = array(3,-3,-6,-8,-9,-15,-62,-21,-0,-16,-33)) . ' <br> soll: 3, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = array(1,5,9,array(16,22),array(18,21),20)) . ' <br> soll: 22, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = array(15,array(1,3,6,20,array(21,5,14,6)),array(array(array(17,13,array(60)),15),16),-10)) . ' <br> soll: 60, ist: ' . var_export(antwort($a), true) . '<br><br>';