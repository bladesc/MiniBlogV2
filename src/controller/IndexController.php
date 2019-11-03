<?php

namespace src\controller;

use src\model\IndexModel;
use src\view\View;

class IndexController extends CommonController
{
    public function index()
    {
        $data = (new IndexModel())->getData();
        (new View())->data($data)->template('default')->file('index')->render();
    }
}