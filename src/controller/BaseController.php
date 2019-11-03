<?php

namespace src\controller;

class BaseController
{
    protected $globals;

    public function __construct($globals)
    {
        $this->globals = $globals;
    }
}