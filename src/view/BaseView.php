<?php

namespace src\view;

use src\language\Language;
use src\config\Config;
use src\core\request\Request;

class BaseView
{
    protected $config;
    protected $templateName = 'default';
    protected $fileName = 'index';
    protected $request;
    protected $translation;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config = (new Config())->getConfigContainer();
        $this->translation = (new Language())->getTranslation();
        $this->templateName = $this->config['template']['defaultTemplate'];
        $this->templateName = $this->config['template']['defaultFile'];
    }
}