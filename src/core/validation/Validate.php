<?php


namespace src\core\validation;


use src\config\Config;

class Validate
{
    protected $configContainer;
    protected $value = null;
    protected $description = null;
    protected $errors = [];

    public function __construct()
    {
        $this->configContainer = (new Config())->getConfigContainer();
    }

    public function set($value, string $description = null)
    {
        $this->value = $value;
        if ($description) {
            $this->description = $description;
        }
        return $this;
    }

    public function get()
    {
        return $this->value;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function reset()
    {
        $this->value = null;
        $this->errors = [];
    }

    public function checkIfEmpty()
    {
        if (!empty($this->value) && $this->value != 0) {
            $this->errors[] = $this->description . ' - empty';
        }
        return $this;
    }

    public function validateText(int $minCharNumber, int $maxCharNumber)
    {
        if ((strlen($this->value) < $minCharNumber) || (strlen($this->value) > $maxCharNumber)) {
            $this->errors[] = $this->description . " - correct lenght min {$minCharNumber} max {$maxCharNumber}";
        }
        return $this;
    }

    public function validateEmail()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = $this->description . ' - wrong';
        }
        return $this;
    }

    public function validatePassword()
    {
        if (strlen($this->value) < $this->configContainer['blog']['minPasswordLength']) {
            $this->errors[] = $this->description . ' - too short';
        }
        return $this;
    }

    public function comparePasswords(string $passwordToCompare)
    {
        if ($this->value !== $passwordToCompare) {
            $this->errors[] = $this->description . ' not same';
        }
        return $this;
    }

    public function filterValue()
    {
        $this->value = strip_tags(trim($this->value));
        return $this;
    }

}