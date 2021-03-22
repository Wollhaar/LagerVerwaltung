<?php

class db {
    private static $name = 'dg_lager';
    private static $user = 'wolledave';
    private static $host = 'db4free.net';
    private static $password = 'developer01';
    private static $db;

    public static function db() {
        if (is_null(self::$db)) {
            mysqli_connect(self::$host, self::$user,self::$password,self::$name, '3306');
        }
    }

    private static function install() {
        $sql = array();

        $sql[] = "";
    }
}