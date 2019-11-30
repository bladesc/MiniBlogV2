<?php

namespace src\core\validation;

use src\config\Config;

class Validator
{
    protected $configContainer;

    public function __construct()
    {
        $this->configContainer = (new Config())->getConfigContainer();
    }

    public function validateText(string $text, int $minCharNumber, int $maxCharNumber): bool
    {
        if ((strlen($text) >= $minCharNumber) && (strlen($text) <= $maxCharNumber)) {
            return true;
        }
        return false;
    }

    public function validateEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function validatePassword(string $password): bool
    {
        if (strlen($password) >= $this->configContainer['blog']['minPasswordLength']) {
            return true;
        }
        return false;
    }

    public function comparePasswords(string $password1, string $password2): bool
    {
        if ($password1 === $password2) {
            return true;
        }
        return false;
    }

    public function filterValue($value)
    {
        return strip_tags(trim($value));
    }

}