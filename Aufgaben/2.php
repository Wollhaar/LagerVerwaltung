<?php

// Funktion soll  aus gerade Stellen liefern

function antwort($data) {
    $antwort = false;
    // Hier schreibst Du Deine Lösung

    return $antwort;
}


echo 'Test 1 ' . ($a = 'abcdefghij') . ' <br> soll: acegi, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = 'anskdTrht') . ' <br> soll: asdrt, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = 'XNJI12MKO34nji56ka') . ' <br> soll: NI2K3ni6a, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = '!"§$%&/()=?') . ' <br> soll: "$&(=, ist: ' . var_export(antwort($a), true) . '<br><br>';