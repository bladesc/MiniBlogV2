<?php declare(strict_types=1);
include "../src/core/error/ErrorHandler.php";
include "../src/core/autoloader/Autoloader.php";
include "../src/core/installation/Installation.php";

use src\core\route\Route;
use src\core\request\Request;

(new Route(new Request()))->run();
