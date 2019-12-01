<?php

namespace src\session;

class Session
{
    public static function add(string $key, string $value): bool
    {
        if (!empty($_SESSION[$key])) {
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }

    public static function change(string $key, string $value): bool
    {
            $_SESSION[$key] = $value;
            return true;
    }

    public static function remove(string $key)  : bool
    {
        unset($_SESSION[$key]);
        return true;
    }
}