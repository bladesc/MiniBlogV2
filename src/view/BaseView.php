<?php

namespace src\view;

use src\language\Ttranslation;
use src\config\Config;
use src\core\request\Request;

class BaseView
{
    protected $config;
    protected $templateName = 'default';
    protected $fileName = 'index';
    protected $request;
    protected $translations;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config = (new Config())->getConfigContainer();
        $this->translations = (new Ttranslation())->getTranslations();
        $this->templateName = $this->config['template']['defaultTemplate'];
        $this->templateName = $this->config['template']['defaultFile'];
    }
}