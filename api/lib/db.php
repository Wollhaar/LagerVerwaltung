<?php

class db {
    private static $name = 'db97098_57';
    private static $user = 'db97098_57';
    private static $host = 'mysql5.gute-it.de';
    private static $password = '4f?KvdevjmKb';
    private static $connection;

    public function __construct() {
        self::$connection = new mysqli(self::$host, self::$user,self::$password,self::$name, '3306');
    }

    public static function get_db() {
        if (is_null(self::$connection)) {
            new self();
        }
        return self::$connection;
    }
}