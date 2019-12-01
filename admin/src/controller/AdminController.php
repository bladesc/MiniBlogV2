<?php

namespace admin\src\controller;

use src\controller\CommonController;
use src\view\View;

class AdminController extends CommonController
{
    public function admin()
    {
        (new View($this->request))->admin()->template('default')->file('index')->render();
    }

}