<?php declare(strict_types=1);
include "../src/core/error/ErrorHandler.php";
include "../src/core/autoloader/Autoloader.php";

use src\core\route\Route;
use src\core\request\Request;
use src\core\installation\Installation;

$request = new Request();
(new Installation($request))->checkIfInstalled();
(new Route($request))->run();
