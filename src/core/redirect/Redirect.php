<?php

namespace src\core\redirect;

class Redirect
{
    public static function redirectTo(string $url): void
    {
        header("Location: $url");
        exit;
    }
}