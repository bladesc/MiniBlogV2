<?php

namespace src\session;

class Session
{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function add(string $key, $value): bool
    {
        if (!empty($_SESSION[$key])) {
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }

    public function change(string $key, $value): bool
    {
        $_SESSION[$key] = $value;
        return true;
    }

    public function remove(string $key): bool
    {
        unset($_SESSION[$key]);
        return true;
    }

    public function get(string $key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
    }
}