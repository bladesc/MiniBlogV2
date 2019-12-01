<?php

namespace admin\src\controller;

use admin\src\model\CategoryModel;
use src\controller\CommonController;
use src\model\CommonModel;
use src\view\View;

class AdminController extends CommonController
{
    public function admin()
    {
        $model = (new CommonModel($this->request));
        $data = $model->addCategory()->getData();
        (new View($this->request))->admin()->template('default')->file('index')->render();
    }

}