<?php

namespace src\language;

class Ttranslation
{
    public const LANG_PL = 'pl';
    public const LANG_EN = 'en';

    protected $language;
    protected $translations;
    protected $defaultLang;

    public function __construct()
    {
        include(self::LANG_PL . '.php');
        include(self::LANG_EN . '.php');
        $this->translations = new \stdClass();
        $this->translations->{self::LANG_PL} = ${self::LANG_PL};
        $this->translations->{self::LANG_EN} = ${self::LANG_EN};
    }

    public function getTranslations(): object
    {
        return $this->translations;
    }
}