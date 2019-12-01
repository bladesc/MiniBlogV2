<?php


namespace admin\src\controller;


use src\controller\CommonController;
use src\view\View;

class SettingsController extends CommonController
{
    public function settings()
    {
        (new View($this->request))->admin()->template('default')->file('settings')->render();
    }
}