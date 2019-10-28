<?php


namespace src\core\route;


class Path
{
    protected $controller;
    protected $action;

    /**
     * @param string $controller
     * @return Path
     */
    public function setController(string $controller): Path
    {
        $this->controller = strip_tags(trim($controller));
        return $this;
    }

    /**
     * @param string $action
     * @return Path
     */
    public function setAction(string $action): Path
    {
        $this->action = strtolower(strip_tags(trim($action)));
        return $this;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return ucfirst(strtolower($this->controller)) . 'Controller';
    }

    /**
     * @return string
     */
    public function getControllerFullName(): string
    {
        return 'src\Controller\\' . $this->getControllerName();
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}