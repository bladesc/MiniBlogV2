<?php

namespace src\Helper;

class ControllerHelper
{
    protected $action;

    public function setPage(string $action)
    {
        $this->action = $action;
    }

    public function getControllerName(): string
    {
        return ucfirst(strtolower($_GET['page'])) . 'Controller';
    }

    public function getControllerFullName()
    {
        return 'src\Controller\\' . $this->getControllerName();
    }
}