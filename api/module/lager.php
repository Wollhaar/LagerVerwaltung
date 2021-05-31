<?php


class lager
{
    public static function get_all() {
        return array('data' => class_lager::getAll(), 'action' => 'fill_list', 'what' => self::class);
    }

    public static function get_details($id) {}

    public static function post_details($id, $daten) {}

    public static function get_bestand($id) {

    }
}