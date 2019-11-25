<?php

namespace src\controller;

use src\model\IndexModel;
use src\view\View;

class IndexController extends CommonController
{
    public function index()
    {
        $data = (new IndexModel($this->request))->getData();
        (new View($this->request))->data($data)->template('default')->file('index')->render();
    }
}