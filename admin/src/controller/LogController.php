<?php


namespace admin\src\controller;


use admin\src\model\LogModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class LogController extends CommonController
{
    public function log()
    {
        $data = (new LogModel($this->request))->getLogs()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('log')->render();
    }

    public function prepareDelete()
    {
        $model = (new LogModel($this->request));
        $data = $model->getLog()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('logdelete')->render();
    }

    public function delete()
    {
        $model = (new LogModel($this->request));
        $data = $model->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=log');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('logdelete')->render();
    }
}