<?php


namespace src\Core;


class Path
{
    protected $controller;
    protected $action;

    public function setController(string $controller)
    {
        $this->controller = strip_tags(trim($controller));
    }

    public function setAction(string $action)
    {
        $this->action = strtolower(strip_tags(trim($action)));
    }

    public function getControllerName(): string
    {
        return ucfirst(strtolower($this->controller)) . 'Controller';
    }

    public function getControllerFullName()
    {
        return 'src\Controller\\' . $this->getControllerName();
    }

    public function getAction(): string
    {
        return $this->action;
    }
}