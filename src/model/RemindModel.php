<?php


namespace src\model;


class RemindModel extends CommonModel
{
    public function getData(): array
    {
        $data = $this->getMenuData();
        return $data;
    }
}