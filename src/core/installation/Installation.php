<?php

namespace src\core\installation;

use src\core\request\Request;
use src\core\route\Route;

class Installation
{
    protected $request;
    protected $install;

    public const DEFAULT_PAGE_INSTALLATION = 'installation';

    public const PAGE_START = 'start';
    public const PAGE_DATABASE = 'database';
    public const PAGE_BLOG = 'blog';
    public const PAGE_END = 'end';
    public const PAGE_REMOVE = 'remove';

    public const DEFAULT_PAGE = 'index';


    public function __construct(Request $request)
    {
        $this->install = new Install();
        $this->request = $request;
    }

    public function checkIfInstalled(): void
    {
        if (!$this->install->checkIfInstalled()) {
            if (!$this->request->query()->has(Route::DEFAULT_KEY_INSTALL)) {
                header("location: {$this->getUrl(Route::DEFAULT_KEY_INSTALL, self::PAGE_START)}");
            }
        } elseif ($this->install->getCheckInstallDir()) {
            if ($this->request->query()->has(Route::DEFAULT_KEY_INSTALL)) {
                if ($this->request->query()->get(Route::DEFAULT_KEY_PAGE) !== self::DEFAULT_PAGE_INSTALLATION) {
                    header("location: {$this->getUrl(Route::DEFAULT_KEY_INSTALL, self::PAGE_REMOVE)}");
                }
            } else {
                header("location: {$this->getUrl(Route::DEFAULT_KEY_INSTALL, self::PAGE_REMOVE)}");
            }
        }
    }

    public function getUrl(string $pageKay, string $pageValue): string
    {
        return self::DEFAULT_PAGE . '.php' . '?' . $pageKay . '=' . $pageValue;
    }

}
