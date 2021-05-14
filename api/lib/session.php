<?php

class session {
    public static $data = array();
    public static $doku = false;

    public static function get() {
        if (empty($data)) {
            session_start();
            self::$data = $_SESSION;
            session_abort();
        }
        return self::$data;
    }

    public static function set($data) {
        self::$data = $data;
    }

    public static function save() {
        session_start();
        $_SESSION = self::$data;
        session_write_close();
    }

    public static function destroy() {
        session_start();
        $_SESSION = array();
        self::$data = array();
        session_destroy();
        session_write_close();
    }
}