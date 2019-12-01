<?php


namespace admin\src\controller;


use src\controller\CommonController;
use src\view\View;

class TagController extends CommonController
{
    public function tag()
    {
        (new View($this->request))->admin()->template('default')->file('tags')->render();
    }
}