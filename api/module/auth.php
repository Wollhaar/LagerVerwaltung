<?php

class auth
{
    static $authenticated;

    public static function post_login($username, $password): array
    {
        $user = class_user::get($username);
        if (hashhash($password) === $user->password_hash) {
            $session_data = array_merge(session::get(), array('user' => $user));
            session::set($session_data);
            session::save();

            return $session_data;
        }

        return array(
            'action' => 'error',
            'data' => array('title' => 'Login failed', 'message' => 'Wrong username or password.'),
            'user' => array()
        );
    }

    public static function get_logout(): array
    {
        self::$authenticated = null;
        session::destroy();

        return array('action' => 'revert_user', 'data' => array(), 'user' => array());
    }

    public static function get_check(): array
    {
        $session_data = session::get();
        self::$authenticated = $session_data['user']['authenticated'];

        if (self::$authenticated) {
            return $session_data;
        }
        return array('action' => null, 'data' => array(), 'user' => array());
    }
}

function hashhash(string $str, $boo = false): string
{
    $hash = sha1($str, $boo);
    if (max(count_chars($hash, 1) < 10)) $hash = hashhash($hash);

    return $hash;
}