<?php

include "..\src\Config\Config.php";

use src\Config\Config;

$config = Config::getConfig();
print_r($config->getConfigContainer());


