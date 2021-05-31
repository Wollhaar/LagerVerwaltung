<?php


class transaktion
{
    public static function get_all() {
        return array('data' => class_transaktion::getAll(), 'action' => 'fill_list', 'what' => self::class);
    }

    public static function get_ueberweisungDetails($daten) {
        return array('data' => class_transaktion::details($daten), 'action' => 'open_list', 'what' => self::class);
    }

    public static function get_searchUeberweisungByArtikel($daten) {}

    public static function get_searchUeberweisungByLieferant($daten) {}

    public static function put_ueberweisung($daten) {}

    public static function post_ueberweisung($id, $daten) {}

    public static function del_ueberweisung($id) {}

    public static function error($title, $message)
    {
        return array(
            'data' => array('title' => $title, 'message' => $message),
            'action' => 'error',
            'what' => self::class
        );
    }
}