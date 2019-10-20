<?php
set_error_handler("warning_handler", E_ALL);

function warning_handler($errno, $errstr) {
    throw new ErrorException($errstr, $errno);
}

