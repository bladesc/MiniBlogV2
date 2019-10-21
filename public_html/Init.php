<?php declare(strict_types=1);
include "..\src\Core\Error\ErrorHandler.php";
include "..\src\Core\Autoloader\Autoloader.php";
include "..\src\Core\Installation\Installation.php";

use src\Core\Route\Route;

/*$config = Config::getConfig();
$configContainer = $config->getConfigContainer();*/

(new Route($GLOBALS))->run();
