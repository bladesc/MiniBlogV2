<?php


namespace installation\src\controller;


use installation\src\model\StartModel;
use src\controller\CommonController;
use src\view\View;

class EndController extends CommonController
{
    public function end()
    {
        (new View($this->request))->install()->data()->template('installation')->file('end')->render();
    }
}