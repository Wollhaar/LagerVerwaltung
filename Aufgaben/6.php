<?php

// Prüfung ob ein Wert TRUE ist

function antwort($data) {
    $antwort = false;
    // Hier schreibst Du Deine Lösung

    return $antwort;
}


echo 'Test 1 ' . ($a = 'true') . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = true) . ' <br> soll: true, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = 1) . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = array()) . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';