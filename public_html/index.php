<?php

include "..\src\Config\Config.php";
include "..\src\Library\Autoloader.php";
include "..\src\Library\Initial.php";

use src\Config\Config;
use src\Helper\ControllerHelper;

/*$config = Config::getConfig();
$configContainer = $config->getConfigContainer();*/
$helper = new ControllerHelper();
if (!empty($_GET['page'])) {
    $helper->setPage($_GET['page']);
    $className = $helper->getControllerFullName();
    $controller = new $className();
} else {
    $helper->setPage('index');
    $className = $helper->getControllerFullName();
    $controller = new $className();
}
$controller->index();

/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";*/