<?php

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
}
