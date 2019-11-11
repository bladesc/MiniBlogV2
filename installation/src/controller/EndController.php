<?php


namespace installation\src\controller;


use installation\src\model\StartModel;
use src\controller\CommonController;
use src\view\View;

class EndController extends CommonController
{
    public function end()
    {
        $data = (new StartModel($this->request))->getDataStep3();
        (new View($this->request))->data($data)->template('installation')->file('end')->render();
    }
}