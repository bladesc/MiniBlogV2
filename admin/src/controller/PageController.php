<?php


namespace admin\src\controller;


use src\controller\CommonController;
use src\view\View;

class PageController extends CommonController
{
    public function page()
    {
        (new View($this->request))->admin()->template('default')->file('pages')->render();
    }
}