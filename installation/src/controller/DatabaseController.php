<?php


namespace installation\src\controller;


use installation\src\model\DatabaseModel;
use src\config\Config;
use src\controller\CommonController;
use src\view\View;

class DatabaseController extends CommonController
{
    public function database()
    {
        $data = (new DatabaseModel($this->request))->getData();
        (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
    }

    public function checkConnection()
    {
        $model = (new DatabaseModel($this->request));
        $config = Config::getConfig();
        $data = (new DatabaseModel($this->request))->getData();
        print_r($data); die;
        (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
    }
}