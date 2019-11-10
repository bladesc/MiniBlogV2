<?php

namespace src\controller;

use src\core\request\Request;

class BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}