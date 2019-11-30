<?php


namespace src\model;


class IndexModel extends CommonModel
{
    public function getData(): array
    {
        $data = $this->getMenuData();
        return $data;
    }
}