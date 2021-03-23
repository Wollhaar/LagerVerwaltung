<?php

// Ablaufdatum berechnen - Ablaufdatum ist immer am letzten Monatstag nach 12 Monaten, bitte berechnen

function antwort($data) {
    $antwort = date('d.m.Y', strtotime('last day of +1 year +1 month', strtotime($data)));

    return $antwort;
}


echo 'Test 1 ' . ($a = '01.01.2000') . ' <br> soll: 28.02.2001, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = '15.03.2010') . ' <br> soll: 30.04.2011, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = '07.04.2020') . ' <br> soll: 31.05.2021, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = '03.12.1999') . ' <br> soll: 31.01.2000, ist: ' . var_export(antwort($a), true) . '<br><br>';