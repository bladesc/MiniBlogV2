<?php declare(strict_types=1);
include "../src/core/error/ErrorHandler.php";
include "../src/core/autoloader/Autoloader.php";

use src\core\route\Route;
use src\core\request\Request;
use src\core\installation\Installation;
use src\core\log\Log;

$request = new Request();
(new Installation($request))->checkIfInstalled();
(new Log($request))->addLog();
(new Route($request))->run();
