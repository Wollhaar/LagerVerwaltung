<?php

class artikel {

    public static function get_details($id) {
        return array('data'=> new class_artikel(class_artikel::getSingle($id)), 'action' => '', 'what' => self::class);
    }

    public static function put_new($data) {

    }

    public static function post_edit($data) {
        if (class_artikel::edit($data['id'], $data))
            return array('data' => class_artikel::getAll(), 'action' => 'fill_list', 'what' => self::class);
        else return self::error('Update fehlgeschlagen.', 'Daten ungültig');
    }

    public static function del_delete($id) {

    }

    public static function get_searchByName($data) {
        $artikel = new class_artikel(class_artikel::search($data['name']));
        unset($artikel->anzahl);
        return array('data' => $artikel, 'action' => 'open_record', 'what' => self::class);
    }

    public static function get_verlauf($id) {

    }

    public static function get_All() {
        return array('data' => class_artikel::getAll(), 'action' => 'fill_list', 'what' => self::class);
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

