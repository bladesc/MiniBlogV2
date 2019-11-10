<?php

namespace src\view;

use src\config\Config;
use src\core\request\Request;

class BaseView
{
    protected $config;
    protected $templateName = 'default';
    protected $fileName = 'index';
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config = Config::getConfig()->getConfigContainer();
        $this->templateName = $this->config['template']['defaultTemplate'];
        $this->templateName = $this->config['template']['defaultFile'];
    }
}