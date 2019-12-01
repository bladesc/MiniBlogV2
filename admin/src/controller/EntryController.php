<?php


namespace admin\src\controller;


use src\controller\CommonController;
use src\view\View;

class EntryController extends CommonController
{
    public function entry()
    {
        (new View($this->request))->admin()->template('default')->file('entries')->render();
    }
}