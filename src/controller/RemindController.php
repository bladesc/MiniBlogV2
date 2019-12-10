<?php


namespace src\controller;


use src\model\RemindModel;
use src\view\View;

class RemindController extends CommonController
{
    public function remind()
    {
        $data = (new RemindModel($this->request))->getData();
        (new View($this->request))->data($data)->template('default')->file('remind')->render();
    }
}