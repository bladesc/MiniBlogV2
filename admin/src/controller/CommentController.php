<?php


namespace admin\src\controller;


use admin\src\model\CommentModel;
use admin\src\model\EntryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\permission\Permission;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class CommentController extends CommonController
{
    public function comment()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CommentModel($this->request))->getComments()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('comments')->render();
    }

    public function prepareDelete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CommentModel($this->request))->getComment()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsdelete')->render();
    }

    public function delete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new CommentModel($this->request));
        $data = $model->getComment()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=comment');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsdelete')->render();
    }

    public function prepareUpdate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CommentModel($this->request))->getComment()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsupdate')->render();
    }

    public function update()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new CommentModel($this->request));
        $data = $model->getComment()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['changedSuc']);
            Redirect::redirectTo('index.php?pageadmin=comment');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('commentsupdate')->render();
    }
}