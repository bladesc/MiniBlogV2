<?php

namespace src\Controller;

use src\Core\DiContainer\DiContainer;

class BaseController
{
    protected $diContainer;

    public function __construct(DiContainer $diContainer)
    {
        $this->diContainer = $diContainer;
    }
}