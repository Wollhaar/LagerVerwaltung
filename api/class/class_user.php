<?php


class class_user
{
    public $user_id;
    public $username;
    public $password_hash;
    public $email;
    public $first_name;
    public $last_name;

    static $db;

    public function __construct($data)
    {
        $this->user_id = $data['user_id'];
        $this->username = $data['username'];
        $this->password_hash = $data['password'];
        $this->email = $data['email'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
    }

    public static function get(string $username): class_user
    {
        self::$db = db::get_db();

        $sql = "SELECT * FROM `user` WHERE username = ? LIMIT 1";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        return new class_user($stmt->get_result()->fetch_assoc() ?? array());
    }
}