<?php


namespace src\controller;


use src\model\NotfoundModel;
use src\view\View;

class NotFoundController extends CommonController
{
    public function notFound()
    {
        $data = (new NotfoundModel($this->request))->getData();
        (new View($this->request))->data($data)->template('default')->file('notfound')->render();
    }
}