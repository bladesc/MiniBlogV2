<?php

namespace src\Core;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class Route
 * @package src\Core
 */
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
    public const NOT_FOUND_CONTROLLER = "NotFound";


    /**
     * Route constructor.
     * @param array $allGlobals
     */
    public function __construct(array $allGlobals)
    {
        $this->allGlobals = $allGlobals;
        $this->globals['GET'] = $allGlobals['_GET'];
        $this->globals['POST'] = $allGlobals['_POST'];
        $this->globals['FILES'] = $allGlobals['_FILES'];
        $this->path = new Path();
    }


    /**
     *
     */
    public function initRouteValues(): void
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


    /**
     * @return bool
     */
    public function validateIfExists(): bool
    {
        if (!class_exists($this->controller)) {
            $this->path->setController(self::NOT_FOUND_CONTROLLER);
            $this->path->setAction(self::NOT_FOUND_CONTROLLER);
            $this->controller = $this->path->getControllerFullName();
            $this->action = $this->path->getAction();
            return false;
        }
        return true;
    }


    /**
     *
     */
    public function run(): void
    {
        $this->initRouteValues();
        $this->validateIfExists();
        (new $this->controller)->{$this->action}();
    }
}