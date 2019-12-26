<?php

namespace src\core\installation;

use src\core\request\Request;
use src\core\route\Route;

class Installation
{
    protected $request;
    protected $install;

    public const DEFAULT_PAGE_INSTALLATION = 'install_page';

    public const PAGE_START = 'start';
    public const PAGE_DATABASE = 'database';
    public const PAGE_BLOG = 'blog';
    public const PAGE_END = 'end';
    public const PAGE_REMOVE = 'notremoved';

    public const DEFAULT_PAGE = 'index';


    public function __construct(Request $request)
    {
        $this->install = new Install();
        $this->request = $request;
    }

    public function checkIfInstalled(): bool
    {
        if (!$this->install->checkIfInstalled()) {
            if (!$this->request->query()->has(Route::DEFAULT_KEY_INSTALL)) {
                header("location: {$this->getUrl(Route::DEFAULT_KEY_INSTALL, self::PAGE_START)}");
                die;
            }
        } elseif ($this->install->getCheckInstallDir()) {
            if ($this->request->query()->has(Route::DEFAULT_KEY_INSTALL)) {
                if ($this->request->query()->get(Route::DEFAULT_KEY_INSTALL) !== self::PAGE_REMOVE) {
                    header("location: {$this->getUrl(Route::DEFAULT_KEY_INSTALL, self::PAGE_REMOVE)}");
                    die;
                }
            } else {
                header("location: {$this->getUrl(Route::DEFAULT_KEY_INSTALL, self::PAGE_REMOVE)}");
                die;
            }
        } else {
            return true;
        }
        return false;
    }

    public function getUrl(string $pageKay, string $pageValue): string
    {
        return self::DEFAULT_PAGE . '.php' . '?' . $pageKay . '=' . $pageValue;
    }

}
