<?php


namespace installation\src\model;


use installation\src\installation\Install;
use src\core\db\Connection;
use src\model\CommonModel;

class DatabaseModel extends CommonModel
{
    protected $data = [];

    public function getConnectionInfo(): object
    {
        try {
            $connection = new Connection([
                'hostname' => $this->validator->filterValue($this->request->post()->get('dbaddress')),
                'name' => $this->validator->filterValue($this->request->post()->get('dbname')),
                'charset' => $this->validator->filterValue($this->configContainer['db']['charset']),
                'username' => $this->validator->filterValue($this->request->post()->get('dbuser')),
                'password' => $this->validator->filterValue($this->request->post()->get('dbpassword'))
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

    public function install(): object
    {
        $this->getConnectionInfo();
        if ($this->data['connection'] === false) {
            $this->data['installation'] = false;
        } else {
            if ($this->insertConfigData()) {
                $this->data['installation'] = $this->installDatabase();
            } else {
                $this->data['installation'] = false;
            }
        }
        return $this;
    }

    public function installDatabase(): bool
    {
        return ((new Install())->install()) ? true : false;
    }

    public function insertConfigData(): bool
    {
        $configString = '<?php
            $config[\'db\'][\'hostname\'] = \'' . $this->validator->filterValue($this->request->post()->get('dbaddress')) . '\';
            $config[\'db\'][\'username\'] = \'' . $this->validator->filterValue($this->request->post()->get('dbuser')) . '\';
            $config[\'db\'][\'password\'] = \'' . $this->validator->filterValue($this->request->post()->get('dbpassword')) . '\';
            $config[\'db\'][\'name\'] = \'' . $this->validator->filterValue($this->request->post()->get('dbname')) . '\';
            $config[\'db\'][\'prefix\'] = \'mb_\';
            $config[\'db\'][\'charset\'] = \'utf8mb4\';';

            $file = '../src/config/Database.php';
            if (file_exists($file)) {
                try {
                    file_put_contents($file, $configString);
                    return true;
                } catch (\Exception $e) {
                }
            }
            $this->data['installation'] = false;
            return false;
    }

}