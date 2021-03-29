<?php
// bitte Datei aus Aufgabe 11 lesen und eine summe aus Alle Ellemente Rechnen

function antwort()
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/storage/';

    $antwort = array();
    foreach (scandir($path) as $filename) {
        if (!str_contains($filename, 'data')) continue;
        if (file_exists($path . $filename)) {
            $content = json_decode(file_get_contents($path . $filename), 'true');
            $arr = array();
            foreach ($content as $values) {
                array_push($arr, array_sum($values));
            }
            array_push($antwort, array_sum($arr));
        }
    }

    $antwort = implode(', ', $antwort);
    return $antwort;
}


echo 'Antwort: soll:  105, 495, 382<br>, ist: ' . var_export(antwort(), true) . '<br><br>';