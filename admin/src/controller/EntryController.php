<?php


namespace admin\src\controller;


use admin\src\model\CategoryModel;
use admin\src\model\EntryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\view\View;

class EntryController extends CommonController
{
    public function entry()
    {
        $data = (new EntryModel($this->request))->getEntries()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entries')->render();
    }

    public function prepareCreate()
    {
        $data = (new EntryModel($this->request))->getCategories()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entriescreate')->render();
    }

    public function create()
    {
        $model = (new EntryModel($this->request));
        $data = $model->addEntry()->getCategories()->getData();
        if ($data['entryInserted']) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=entry');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('entriescreate')->render();
    }

    public function prepareUpdate()
    {
        $data = (new EntryModel($this->request))->getCategories()->getEntry()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesupdate')->render();
    }

    public function update()
    {
        $model = (new EntryModel($this->request));
        $data = $model->getEntry()->updateEntry()->getData();
        if ($data['entryUpdated']) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmienono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=entry');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesupdate')->render();
    }

    public function prepareDelete()
    {
        $data = (new EntryModel($this->request))->getEntry()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesdelete')->render();
    }

    public function delete()
    {
        $model = (new EntryModel($this->request));
        $data = $model->getEntry()->deleteEntry()->getData();
        if ($data['entryDeleted']) {
            $this->session->change(Communicate::C_POSITIVE, 'Usunieto pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=entry');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('entriesdelete')->render();
    }
}