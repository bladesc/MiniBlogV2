<?php


namespace admin\src\controller;


use src\controller\CommonController;
use src\view\View;

class CommentController extends CommonController
{
    public function comment()
    {
        (new View($this->request))->admin()->template('default')->file('comments')->render();
    }
}