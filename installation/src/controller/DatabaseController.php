<?php


namespace installation\src\controller;


use installation\src\model\DatabaseModel;
use src\controller\CommonController;
use src\view\View;

class DatabaseController extends CommonController
{
    public function database()
    {
        $data = (new DatabaseModel($this->request))->getData();
        (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
    }

    public function check()
    {
        $model = (new DatabaseModel($this->request));
        $checkConnection = $model->checkConnection();
        $data = (new DatabaseModel($this->request))->getData();
        echo 1; die;
        (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
    }
}