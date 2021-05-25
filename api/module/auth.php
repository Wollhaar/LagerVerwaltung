<?php

class auth
{
    static $authenticated = false;

    public static function post_login($username, $password): array
    {
        $user = class_user::get($username);
        if (hashhash($password) === $user->password_hash) {
            unset($user->password_hash);
            self::$authenticated = true;
            $user->authenticated = self::$authenticated;

            $session_data = array_merge(session::get(), array('user' => $user));
            session::set($session_data);
            session::save();

            return array_merge($session_data, array('action' => 'check_user', 'data' => array()));
        }

        return array(
            'action' => 'error',
            'data' => array('title' => 'Login failed', 'message' => 'Wrong username or password.'),
            'user' => array()
        );
    }

    public static function get_logout(): array
    {
        self::$authenticated = false;
        session::destroy();

        return array('action' => 'revert_user', 'data' => array(), 'user' => array());
    }

    public static function get_check(): array
    {
        $session_data = session::get();
        if (isset($session_data['user']))
            self::$authenticated = $session_data['user']->authenticated;

        if (self::$authenticated)
            return array_merge($session_data, array('action' => 'check_user', 'data' => array()));

        return array('action' => 'check_user', 'data' => array(), 'user' => array('authenticated' => false));
    }
}

function hashhash(string $str, $boo = false): string
{
    $hash = sha1($str, $boo);
    if (count_chars($hash, 1) < 10) $hash = hashhash($hash);

    return $hash;
}