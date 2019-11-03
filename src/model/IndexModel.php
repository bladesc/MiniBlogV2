<?php


namespace src\model;


class IndexModel extends CommonModel
{
    public function getData()
    {
        $data = $this->getMenuData();
        return $data;
    }
}