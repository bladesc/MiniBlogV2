<?php


namespace admin\src\controller;


use admin\src\model\PageModel;
use admin\src\model\SettingsModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class SettingsController extends CommonController
{
    public function settings()
    {
        $data = (new SettingsModel($this->request))->getSettings()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('settings')->render();
    }

    public function prepareUpdate()
    {
        $data = (new SettingsModel($this->request))->getSetting()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('settingsupdate')->render();
    }

    public function update()
    {
        $model = (new SettingsModel($this->request));
        $data = $model->updateItem()->getSettings()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmieniono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=settings');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('settingsupdate')->render();
    }
}