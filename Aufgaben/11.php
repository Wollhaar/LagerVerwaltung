<?php
// bitte $data als JSON im einer Datei speichern

function antwort($data, $filename = 'data')
{
    $filename .= '_' . uniqid() . '.json';
    $data = json_encode($data);

    $path = $_SERVER['DOCUMENT_ROOT'] . '/storage/';
    if (!file_exists($path))
        mkdir($path);

    return  file_put_contents($path . $filename, $data)
        ? 'success' : 'failed';
}


echo 'Test 1 ' . json_encode($a = array(array('a' => 10, 'b' => 5, 'c' => 20),
        array('a' => 10, 'b' => 5, 'c' => 20),
        array('a' => 10, 'b' => 5, 'c' => 20))) . ' <br>' .
        'Success(?): ' . antwort($a) .'<br/><br/><br/>';

echo 'Test 2 ' .  json_encode($a = array(array('a' => 100, 'b' => 51, 'c' => 22),
        array('b' => 55, 'c' => 200),
        array('a' => -10, 'b' => 57, 'c' => 20))) . ' <br/>' .
        'Success(?): ' . antwort($a) . '<br/><br/><br/>';

echo 'Test 3 ' . json_encode($a = array(array('a' => -100, 'b' => 51, 'c' => 22),
        array('a' => 55, 'c' => 200),
        array('a' => 77, 'b' => 57, 'c' => 20))) . ' <br>' .
        'Success(?): ' . antwort($a) . '<br/><br/><br/>';