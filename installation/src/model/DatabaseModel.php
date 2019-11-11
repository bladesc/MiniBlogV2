<?php


namespace installation\src\model;


use src\model\CommonModel;

class DatabaseModel extends CommonModel
{
    public function getData()
    {
        if ($this->request->query()->has('dbinstall')) {
            echo 1; die;
        }
        return [];
    }

    public function checkConnection()
    {

    }
}