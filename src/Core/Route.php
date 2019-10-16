<?php

namespace src\Core;

class Route
{
    protected $allGlobals;
    protected $globals = [];
    protected $page;

    protected $path;

    protected $controller;
    protected $action;

    public const DEFAULT_CONTROLLER = "Index";
    public const DEFAULT_ACTION = "Index";

    public function __construct(array $allGlobals)
    {
        $this->allGlobals = $allGlobals;
        $this->globals['GET'] = $allGlobals['_GET'];
        $this->globals['POST'] = $allGlobals['_POST'];
        $this->globals['FILES'] = $allGlobals['_FILES'];
        $this->path = new Path();
    }

    public function initRouteValues()
    {
        if (!empty($this->globals['GET']['page'])) {
            $this->path->setController($this->globals['GET']['page']);
            if (!empty($this->globals['GET']['action'])) {
                $this->path->setAction($this->globals['GET']['action']);
            } else {
                $this->path->setAction($this->globals['GET']['page']);
            }
        } else {
            $this->path->setController(self::DEFAULT_CONTROLLER);
            $this->path->setAction(self::DEFAULT_ACTION);
        }

        $this->action = $this->path->getAction();
        $this->controller = $this->path->getControllerFullName();
    }

    public function run()
    {
        $this->initRouteValues();
        (new $this->controller)->{$this->action}();
    }

}