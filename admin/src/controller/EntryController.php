<?php


namespace admin\src\controller;


use admin\src\model\CategoryModel;
use admin\src\model\EntryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\permission\Permission;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class EntryController extends CommonController
{
    public function entry()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new EntryModel($this->request))->getEntries()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entries')->render();
    }

    public function prepareCreate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new EntryModel($this->request))->getCategories()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entriescreate')->render();
    }

    public function create()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new EntryModel($this->request));
        $data = $model->insertItem()->getCategories()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['addedSuc']);
            Redirect::redirectTo('index.php?pageadmin=entry');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('entriescreate')->render();
    }

    public function prepareUpdate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new EntryModel($this->request))->getCategories()->getEntry()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesupdate')->render();
    }

    public function update()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new EntryModel($this->request));
        $data = $model->getEntry()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['changedSuc']);
            Redirect::redirectTo('index.php?pageadmin=entry');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesupdate')->render();
    }

    public function prepareDelete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new EntryModel($this->request))->getEntry()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesdelete')->render();
    }

    public function delete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new EntryModel($this->request));
        $data = $model->getEntry()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=entry');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesdelete')->render();
    }
}