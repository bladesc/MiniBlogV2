<?php


namespace admin\src\controller;


use admin\src\model\CommentModel;
use admin\src\model\EntryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class CommentController extends CommonController
{
    public function comment()
    {
        $data = (new CommentModel($this->request))->getComments()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('comments')->render();
    }

    public function prepareDelete()
    {
        $data = (new CommentModel($this->request))->getComment()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsdelete')->render();
    }

    public function delete()
    {
        $model = (new CommentModel($this->request));
        $data = $model->getComment()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Usunieto pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=comment');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsdelete')->render();
    }

    public function prepareUpdate()
    {
        $data = (new CommentModel($this->request))->getComment()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsupdate')->render();
    }

    public function update()
    {
        $model = (new CommentModel($this->request));
        $data = $model->getComment()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmienono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=comment');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsupdate')->render();
    }
}