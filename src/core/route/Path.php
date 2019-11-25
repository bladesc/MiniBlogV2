<?php


namespace src\core\route;


class Path
{
    protected $controller;
    protected $page;
    protected $action;

    protected $installState = false;


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

    public function setInstallState(bool $state): object
    {
        $this->installState = $state;
        return $this;
    }

    public function getController(): string
    {
        return $this->controller;
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
        $name = 'src\Controller\\' . $this->getControllerName();
        if ($this->installState === true) {
            $name = 'installation\\' . $name;
        }
        return $name;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

}