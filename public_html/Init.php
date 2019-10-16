<?php
include "..\src\Core\ErrorHandler.php";
include "..\src\Core\Autoloader.php";

use src\Core\Route;

/*$config = Config::getConfig();
$configContainer = $config->getConfigContainer();*/

(new Route($GLOBALS))->run();
