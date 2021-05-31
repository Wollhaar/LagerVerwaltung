<?php


class lieferant
{
    public static function get_all() {
        return array('data' => class_lieferant::getAll(), 'action' => 'fill_list', 'what' => self::class);
    }

    public static function get_details($id) {
        return array('data'=> new class_lieferant(class_lieferant::getSingle($id)), 'action' => '', 'what' => self::class);
    }

    public static function post_edit($data) {
        if (class_lieferant::edit($data['id'], $data))
            return array('data' => class_lieferant::getAll(), 'action' => 'fill_list', 'what' => self::class);
        else return self::error('Update fehlgeschlagen.', 'Daten ungültig');
    }

    public static function put_new($daten) {}

    public static function del_delete($id) {}

    public static function get_searchByName($arr) {
        return array('data'=> new class_lieferant(class_lieferant::search($arr['name'])), 'action' => 'open_record', 'what' => self::class);
    }

    public static function error($title, $message)
    {
        return array(
            'data' => array('title' => $title, 'message' => $message),
            'action' => 'error',
            'what' => self::class
        );
    }
}