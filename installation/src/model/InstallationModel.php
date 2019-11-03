<?php
/**
 * Created by PhpStorm.
 * User: dszcz
 * Date: 03.11.2019
 * Time: 14:21
 */

namespace src\model;


class InstallationModel extends CommonModel
{
    public function getDataStep1()
    {
        return [];
    }

    public function getDataStep2()
    {
        $data = $this->getMenuData();
        return $data;
    }

    public function getDataStep3()
    {
        $data['installStatusData'] = true;
        return $data;
    }
}