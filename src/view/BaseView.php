<?php

namespace src\view;

use src\config\Config;

class BaseView
{
    protected $config;
    protected $templateName = 'default';
    protected $fileName = 'index';

    public function __construct()
    {
        $this->config = Config::getConfig()->getConfigContainer();
        $this->templateName = $this->config['template']['defaultTemplate'];
        $this->templateName = $this->config['template']['defaultFile'];
    }
}