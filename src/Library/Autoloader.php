<?php

function __autoload($class) {
    $parts = explode('\\', $class);
    $path = '..';
    foreach ($parts as $key => $part) {
        $path .= '/' . $part;
    }
    //throw 404 if doesn't exist
    require $path . '.php';
}