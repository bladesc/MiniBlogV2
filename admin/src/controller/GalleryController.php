<?php


namespace admin\src\controller;


use src\controller\CommonController;
use src\view\View;

class GalleryController extends CommonController
{
    public function gallery()
    {
        (new View($this->request))->admin()->template('default')->file('gallery')->render();
    }
}