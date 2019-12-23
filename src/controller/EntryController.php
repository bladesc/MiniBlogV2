<?php


namespace src\controller;


use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\model\EntryModel;
use src\view\View;

class EntryController extends CommonController
{
    public function entry()
    {
        $data = (new EntryModel($this->request))->getCategories()->getEntry()->getComments()->getData();
        (new View($this->request))->data($data)->template('default')->file('entry')->render();
    }

    public function addComment()
    {
        $data = (new EntryModel($this->request))->addComment()->getCategories()->getEntry()->getComments()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?page=entry&id=' . $this->request->query()->get('id'));
        }
        (new View($this->request))->data($data)->template('default')->file('entry')->render();
    }
}