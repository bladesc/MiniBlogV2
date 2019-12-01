<?php


namespace src\core\general;


class Password
{
    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }

    public static function verify(string $password, string $hashedPassword): bool
    {
        return (password_verify($password, $hashedPassword)) ? true : false;
    }
}