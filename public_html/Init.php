<?php

include "..\src\Library\Autoloader.php";

use src\Core\Route;

/*$config = Config::getConfig();
$configContainer = $config->getConfigContainer();*/

(new Route($GLOBALS))->run();
