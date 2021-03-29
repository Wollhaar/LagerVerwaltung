<?php
// bitte Datei aus Aufgabe 11 lesen und eine summe aus Alle Ellemente Rechnen

function antwort()
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/storage/';

    $antwort = array('a' => 0, 'b' => 0, 'c' => 0);
    foreach (scandir($path) as $filename) {
        if (!str_contains($filename, 'data')) continue;
        if (file_exists($path . $filename)) {
            $content = json_decode(file_get_contents($path . $filename), 'true');
            echo '<h3>Content - values</h3><pre>';
            print_r($content);
            echo '</pre>';
            foreach ($content as $values) {
                $antwort['a'] += $values['a'];
                $antwort['b'] += $values['b'];
                $antwort['c'] += $values['c'];
            }
        }
    }

    $antwort = implode(', ', $antwort);
    return $antwort;
}


echo 'Antwort: soll:  105, 495, 382<br>, ist: ' . var_export(antwort(), true) . '<br><br>';