<?php

namespace src\controller;

use src\core\request\Request;
use src\session\Session;

class BaseController
{
    protected $request;
    protected $session;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();
    }
}