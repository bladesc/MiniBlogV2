<?php


namespace installation\src\model;


use src\core\db\Connection;
use src\model\CommonModel;

class DatabaseModel extends CommonModel
{
    protected $data = [];

    public function getData()
    {
        return $this->data;
    }

    public function getConnectionInfo()
    {
        try {
        $connection = new Connection([
            'hostname' => $this->request->post()->get('dbaddress'),
            'name' => $this->request->post()->get('dbname'),
            'charset' => $this->configContainer['db']['charset'],
            'username' => $this->request->post()->get('dbuser'),
            'password' => $this->request->post()->get('dbpassword')
        ]);
        $this->data['connection'] = ($connection->getConnection() === null) ? 'false' : 'true';
        } catch (\Exception $e) {
            $this->data['connection'] = 'false';
        }
        return $this;
    }

    public function getFormParams()
    {
        $this->data['formparams'] = [];
        return $this;
    }
}