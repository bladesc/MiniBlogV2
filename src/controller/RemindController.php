<?php


namespace src\controller;


use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\ChangeModel;
use src\model\CommonModel;
use src\model\RemindModel;
use src\view\View;

class RemindController extends CommonController
{
    public function remind()
    {
        $data = (new RemindModel($this->request))->getCategories()->getData();
        (new View($this->request))->data($data)->template('default')->file('remind')->render();
    }

    public function processRemind()
    {
        $model = (new RemindModel($this->request));
        $data = $model->remindPassword()->getCategories()->getData();
        if ($data[CommonModel::ACTION_REMINDED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['emailSendedSuc']);
            Redirect::redirectTo('index.php?page=index');
        }
        (new View($this->request))->data($data)->template('default')->file('remind')->render();
    }
}