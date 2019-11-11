<?php


namespace installation\src\controller;


use src\controller\CommonController;
use src\view\View;

class BlogController extends CommonController
{
    public function blog()
    {
        (new View($this->request))->data()->template('installation')->file('blog')->render();
    }
}