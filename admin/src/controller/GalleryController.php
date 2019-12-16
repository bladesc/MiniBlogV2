<?php


namespace admin\src\controller;


use admin\src\model\CategoryModel;
use admin\src\model\GalleryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class GalleryController extends CommonController
{
    public function gallery()
    {
        $data = (new GalleryModel($this->request))->getGalleries()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('gallery')->render();
    }

    public function prepareCreate()
    {
        $data = (new GalleryModel($this->request))->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerycreate')->render();
    }

    public function create()
    {
        $model = (new GalleryModel($this->request));
        $data = $model->insertItem()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=gallery');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerycreate')->render();
    }

    public function prepareDelete()
    {
        $data = (new GalleryModel($this->request))->getGallery()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerydelete')->render();
    }

    public function delete()
    {
        $model = (new GalleryModel($this->request));
        $data = $model->getGallery()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Usunieto pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=gallery');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerydelete')->render();
    }

    public function prepareUpdate()
    {
        $data = (new GalleryModel($this->request))->getGallery()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('galleryupdate')->render();
    }

    public function update()
    {
        $model = (new GalleryModel($this->request));
        $data = $model->getGallery()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmienono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=gallery');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('galleryupdate')->render();
    }

    public function show()
    {
        $data = (new GalleryModel($this->request))->getGallery()->getImages()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('galleryshow')->render();
    }
}