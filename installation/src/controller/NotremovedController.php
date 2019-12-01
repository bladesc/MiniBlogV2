<?php

namespace installation\src\controller;

use src\controller\CommonController;
use src\view\View;

class NotremovedController extends CommonController
{
    public function notRemoved()
    {
        (new View($this->request))->install()->template('default')->file('notremoved')->render();
    }
}