<?php

namespace src\language;

class Language
{
    public const LANG_PL = 'pl';
    public const LANG_EN = 'en';

    protected $language;

    public function __construct(string $language = null)
    {
        $this->language = $language ?? self::LANG_PL;
    }

    public function getTranslation(): array
    {
        include($this->language . '.php');
        return $lang;
    }
}