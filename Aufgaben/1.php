<?php

// Bitte mal prüfen ob Buchstabenanzahl gerade oder ungerade ist -
// es zählen sich nur kleine und große Buchstaben.

function antwort($data) {
    $antwort = false;
    $data = preg_replace('/([^A-Za-z].)*/', '', $data);
    if (!is_float(strlen($data) / 2)) $antwort = true;

    return $antwort;
}

echo 'Test 1 ' . ($a = 'abcdefghij') . ' <br> soll: true, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = 'anskdTrht') . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = 'XNJI12MK034nji56ka') . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = '!"§$%&/()=?') . ' <br> soll: false, ist: ' . var_export(antwort($a), true) . '<br><br>';

if (isset($_GET['match'])) echo '<br/>Output GET-Variable 2: ' . var_export(antwort($_GET['match']), true);