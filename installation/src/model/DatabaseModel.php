<?php


namespace installation\src\model;


use src\core\db\Connection;
use src\model\CommonModel;

class DatabaseModel extends CommonModel
{
    protected $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function getConnectionInfo(): object
    {
        try {
            $connection = new Connection([
                'hostname' => $this->request->post()->get('dbaddress'),
                'name' => $this->request->post()->get('dbname'),
                'charset' => $this->configContainer['db']['charset'],
                'username' => $this->request->post()->get('dbuser'),
                'password' => $this->request->post()->get('dbpassword')
            ]);
            $this->data['connection'] = ($connection->getConnection() === null) ? false : true;
        } catch (\Exception $e) {
            $this->data['connection'] = false;
        }
        return $this;
    }

    public function getFormParams(): object
    {
        $this->data['formparams'] = [];
        return $this;
    }

    public function install(object $install): object
    {
        $this->getConnectionInfo();
        if ($this->data['connection'] === false) {
            $this->data['installation'] = false;
        } else {
            $this->data['installation'] = $this->installDatabase($install);
        }
        return $this;
    }

    public function installDatabase(object $install): bool
    {
        return ($install->install()) ? true : false;
    }

}