<?php

// Bitte mal prüfen ob Buchstabenanzahl gerade oder ungerade ist - es zählen sich nur kleine und große Buchstaben.

function antwort($data) {
    $antwort = false;
    // Hier schreibst Du Deine Lösung

    return $antwort;
}


echo 'Test 1 ' . ($a = 'abcdefghij') . ' <br> soll: true, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = 'anskdTrht') . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = 'XNJI12MKO34nji56ka') . ' <br> soll: true, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = '!"§$%&/()=?') . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';