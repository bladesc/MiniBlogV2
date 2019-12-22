<?php

namespace src\core\helper;

class Helper
{
    public static function show($data, $type = 1)
    {
        echo "<pre>";
        if ($type = 2) {
            var_dump($data);
        } else {
            print_r($data);
        }
        echo "</pre>";
    }

    public static function now()
    {
        return date("Y-m-d H:i:s");
    }

    public static function cut(string $text, $charNumber)
    {
        return substr($text, 0, $charNumber) . '...';
    }
}
