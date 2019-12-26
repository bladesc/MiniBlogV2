<?php

namespace src\controller;

use src\core\request\Request;
use src\language\Ttranslation;
use src\session\Session;

class BaseController
{
    protected $request;
    protected $session;
    protected $translations;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();
        $this->translations = (new Ttranslation())->getTranslations();
    }
}