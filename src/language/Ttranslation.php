<?php

namespace src\language;

use src\model\CommonModel;
use src\session\Session;

class Ttranslation
{
    public const LANG_PL = 'pl';
    public const LANG_EN = 'en';

    protected $language;
    protected $translations;
    protected $defaultLang;
    protected $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->translations = new \stdClass();
        $this->setTranslation();
    }

    protected function setTranslation()
    {
        include(self::LANG_PL . '.php');
        include(self::LANG_EN . '.php');
        $lang = $this->session->get(CommonModel::LANG);
        if($lang !== null) {
            if ($lang === self::LANG_EN) {
                $this->translations->{self::LANG_EN} = ${self::LANG_PL};
                $this->translations->{self::LANG_PL} = ${self::LANG_EN};
            } else {
                $this->translations->{self::LANG_PL} = ${self::LANG_PL};
                $this->translations->{self::LANG_EN} = ${self::LANG_EN};
            }
        } else {
            $this->translations->{self::LANG_PL} = ${self::LANG_PL};
            $this->translations->{self::LANG_EN} = ${self::LANG_EN};
        }
    }

    public function getTranslations(): object
    {
        return $this->translations;
    }
}