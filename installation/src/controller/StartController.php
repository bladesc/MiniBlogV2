<?php


namespace installation\src\controller;

use installation\src\model\StartModel;
use src\view\View;
use src\controller\CommonController;

class StartController extends CommonController
{
    public function start()
    {
        (new View($this->request))->install()->template('installation')->file('start')->render();
    }

}