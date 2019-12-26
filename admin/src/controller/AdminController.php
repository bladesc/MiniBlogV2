<?php

namespace admin\src\controller;

use admin\src\model\CategoryModel;
use src\controller\CommonController;
use src\core\permission\Permission;
use src\model\CommonModel;
use src\view\View;

class AdminController extends CommonController
{
    public function admin()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new CommonModel($this->request));
        $data = $model->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('index')->render();
    }

}