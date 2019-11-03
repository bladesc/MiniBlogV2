<?php


namespace src\controller;

use src\model\InstallationModel;
use src\view\View;

class InstallationController extends CommonController
{
    public function step1()
    {
        (new View())->data()->template('installation')->file('step1')->render();
    }

    public function step2()
    {
        (new View())->data()->template('installation')->file('step2')->render();
    }

    public function step3()
    {
        $data = (new InstallationModel($this->globals))->getDataStep3();
        (new View())->data($data)->template('installation')->file('step3')->render();
    }

    public function notRemoved()
    {
        echo "not removed";
    }
}