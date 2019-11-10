<?php


namespace installation\src\controller;

use installation\src\model\InstallationModel;
use src\view\View;
use src\controller\CommonController;

class InstallationController extends CommonController
{
    public function start()
    {
        (new View($this->request))->install()->template('installation')->file('start')->render();
    }

    public function database()
    {
        (new View($this->request))->install()->data()->template('installation')->file('database')->render();
    }

    public function blog()
    {
        (new View($this->request))->data()->template('installation')->file('blog')->render();
    }

    public function end()
    {
        $data = (new InstallationModel($this->request))->getDataStep3();
        (new View($this->request))->data($data)->template('installation')->file('end')->render();
    }

    public function notRemoved()
    {
        echo "not removed";
    }
}