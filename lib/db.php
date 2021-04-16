<?php

class db {
    private static $name = 'dg_lager';
    private static $user = 'db97098_57';
    private static $host = 'mysql5.gute-it.de';
    private static $password = '4f?KvdevjmKb';
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