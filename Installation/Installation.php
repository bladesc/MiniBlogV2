<?php declare(strict_types=1);
include "..\src\Core\Error\ErrorHandler.php";
include "..\src\Core\Autoloader\Autoloader.php";
include "..\src\Core\Installation\Installation.php";

use src\Core\DiContainer\DiContainer;
use Installation\Route;

$diContainer = new DiContainer();
(new Route($diContainer, $GLOBALS))->run();

/*$install = new Install();
if ($install->install()) {
    echo "installed successfully";
}*/


