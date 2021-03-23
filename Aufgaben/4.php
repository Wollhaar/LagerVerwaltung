<?php

// Zeitprüfung. am Tag 10.03.2020 Im wie viel Tage, wird jemand 18 Jahre alt, wenn jemand bereits 18 Jahre alt ist, dann false als return.

function antwort($data) {
    $antwort = false;
    // Hier schreibst Du Deine Lösung

    return $antwort;
}


echo 'Test 1 ' . ($a = '01.01.2020') . ' <br> soll: 6506, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = '15.03.2015') . ' <br> soll: 4753, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = '07.04.2010') . ' <br> soll: 2950, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = '03.12.2005') . ' <br> soll: 1363, ist: ' . var_export(antwort($a), true) . '<br><br>';