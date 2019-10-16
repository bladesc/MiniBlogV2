<?php

spl_autoload_register(function($class) {
    $parts = explode('\\', $class);
    $path = '..';
    foreach ($parts as $key => $part) {
        $path .= '/' . $part;
    }
    if (file_exists($path . '.php')) {
        require $path . '.php';
    }
});