<?php

namespace src\controller;

use src\core\dicontainer\dicontainer;

class BaseController
{
    protected $diContainer;

    public function __construct(DiContainer $diContainer)
    {
        $this->diContainer = $diContainer;
    }
}