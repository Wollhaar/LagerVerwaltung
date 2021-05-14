<?php

class artikel {

    public static function get_details($id) {
        class_artikel::getSingle($id);
    }

    public static function put_new($data) {

    }

    public static function post_edit($id, $data) {

    }

    public static function del_delete($id) {

    }

    public static function get_searchByName($name) {

    }

    public static function get_verlauf($id) {

    }

    public static function get_All() {
        return array('data' => class_artikel::getAll(), 'action' => 'fill_list', 'what' => self::class);
    }
}