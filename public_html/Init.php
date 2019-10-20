<?php declare(strict_types=1);
include "..\src\Core\Error\ErrorHandler.php";
include "..\src\Core\Autoloader\Autoloader.php";
include "..\src\Core\Install.php";

use src\Core\Route\Route;
use src\Installation\Install;

/*$config = Config::getConfig();
$configContainer = $config->getConfigContainer();*/

(new Route($GLOBALS))->run();
