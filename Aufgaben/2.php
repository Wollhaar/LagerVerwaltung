<?php

// Funktion soll Zeichen aus gerade Stellen liefern

function antwort($data) {
    $antwort = '';
    foreach (str_split($data, 2) as $value)
        $antwort .= substr($value, 0, 1);

    return $antwort ?? false;
}

if (isset($_GET['_ijt'])) echo 'GET ' . $_GET['_ijt'] . ' <br> ' . var_export(antwort($_GET['_ijt']), true) . '<br><br>';

echo 'Test 1 ' . ($a = 'abcdefghij') . ' <br> soll: acegj, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = 'anskdTrht') . ' <br> soll: asdrt, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = 'XNJI12MKO34nji56ka') . ' <br> soll: NI2K3ni6a, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = '!"§$%&/()=?') . ' <br> soll: "$&(=, ist: ' . var_export(antwort($a), true) . '<br><br>';