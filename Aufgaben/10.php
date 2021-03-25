<?php
// Dezimalstellen hinzufügen - Rechne bitte zusammen, nur das, was nach KOmma kommt - die Aufgabe ist schwer!!!

function antwort($data)
{
    foreach ($data as $key => $value) {
        $neg = false;
        $null = false;
        if ($value < 0) $neg = true;

        $value = substr(strval($value), strpos($value, '.') + 1);

        if (strlen($value) < 2) $null = true;
        if ($neg) $value = '-' . $value;
        if ($null) $value .= '0';

        $data[$key] = intval($value);
    }

    return array_sum($data);
}

echo 'Test 1 ' . ($a = array(1.11, 6.11)) . ' <br> soll: 22, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = array(0.91, 30.08)) . ' <br> soll: 99, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = array(-2.15, 2.20)) . ' <br> soll: 5, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = array(1.60, 1.60)) . ' <br> soll: 1.2, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 5 ' . ($a = array(1.123, 5.321)) . ' <br> soll: 444, ist: ' . var_export(antwort($a), true) . '<br><br>';