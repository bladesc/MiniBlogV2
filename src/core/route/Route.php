<?php

namespace src\core\route;

use \src\Core\Installation\Install;
use src\core\request\Request;

/**
 * Class Route
 * @package src\Core
 */
class Route
{
    protected $page;
    protected $path;
    protected $controller;
    protected $action;
    protected $install;

    protected $request;

    public const DEFAULT_CONTROLLER = 'Index';
    public const DEFAULT_ACTION = 'Index';
    public const NOT_FOUND_CONTROLLER = 'NotFound';
    public const DEFAULT_CONTROLLER_INSTALL = 'Start';
    public const DEFAULT_KEY_PAGE = 'page';
    public const DEFAULT_KEY_PAGE_ADMIN = 'pageadmin';
    public const DEFAULT_ACTION_INSTALL = 'Start';
    public const DEFAULT_KEY_INSTALL = 'install_page';
    public const DEFAULT_KEY_ACTION = 'action';
    public const DEFAULT_KEY_CMS_PAGE = 'cmspage';
    public const CMS_CONTROLLER = 'Cms';
    /**
     * Route constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->path = new Path();
        $this->install = new Install();
    }

    /**
     *
     */
    public function initRouteValues(): void
    {
        //installation
        if ($this->request->query()->has(self::DEFAULT_KEY_INSTALL)) {
            $this->path->setInstallState(true);
            $this->path->setController($this->request->query()->get(self::DEFAULT_KEY_INSTALL));
            if (!($this->request->query()->has(self::DEFAULT_KEY_ACTION))) {
                $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_INSTALL));
            } else {
                $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_ACTION));
            }
        } elseif ($this->request->query()->has(self::DEFAULT_KEY_PAGE)) {
            $this->path->setController($this->request->query()->get(self::DEFAULT_KEY_PAGE));
            if (!($this->request->query()->has(self::DEFAULT_KEY_ACTION))) {
                $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_PAGE));
            } else {
                $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_ACTION));
            }
        } elseif ($this->request->query()->has(self::DEFAULT_KEY_CMS_PAGE)) {
            $this->path->setController(self::CMS_CONTROLLER);
            $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_CMS_PAGE));
        } elseif ($this->request->query()->has(self::DEFAULT_KEY_PAGE_ADMIN)) {
            $this->path->setAdminState(true);
            $this->path->setController($this->request->query()->get(self::DEFAULT_KEY_PAGE_ADMIN));
            if (!($this->request->query()->has(self::DEFAULT_KEY_ACTION))) {
                $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_PAGE_ADMIN));
            } else {
                $this->path->setAction($this->request->query()->get(self::DEFAULT_KEY_ACTION));
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
        if ($this->controller === 'src\Controller\CmsController') {
            return true;
        }
        if (!class_exists($this->controller) || !method_exists($this->controller, $this->action)) {
            $this->path->setInstallState(false);
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
        (new $this->controller($this->request))->{$this->action}();
    }
}