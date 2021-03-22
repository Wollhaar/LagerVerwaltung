<?php

$name = 'lagerverwaltung1';
$user = 'davidg';
$host = 'db4free.net';
$password = '41111e0a';

$install = array();

class db {
    private static $name = 'lagerverwaltung1';
    private static $user = 'davidg';
    private static $host = 'db4free.net';
    private static $password = '41111e0a';
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