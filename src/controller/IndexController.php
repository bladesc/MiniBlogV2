<?php

namespace src\controller;

use src\model\IndexModel;
use src\view\View;

class IndexController extends CommonController
{
    public function index()
    {
        $menu = (new IndexModel())->getMenuData();

        $data = [$menu];
        (new View())->data($data)->template('default')->file('index')->render();
    }
}