<?php

namespace src\core\log;

use src\config\Config;
use src\core\db\QueryHelper;
use src\core\db\Tables;
use src\core\helper\Helper;
use src\core\request\Request;
use src\model\CommonModel;
use src\session\Session;

class Log
{
    protected $request;
    protected $db;
    protected $configContainer;
    protected $tables;
    protected $server;
    protected $session;
    protected $userIp;
    protected $loggedUserId;

    public function __construct(Request $request, bool $installationStatus = true)
    {
        $this->request = $request;
        $this->server = ($this->request->all())['server'];
        $this->configContainer = (new Config())->getConfigContainer();
        $this->tables = (new Tables())->getTables();
        $this->session = new Session();
        if ($installationStatus) {
            $this->db = new QueryHelper();
        }
        $this->loggedUserId = $this->session->get(CommonModel::USER_LOG_SES_NAME)[0];
    }

    public function addLog()
    {
        $this->handleIp();
        $data = [
            'ip' => ip2long($this->userIp),
            'date' => Helper::now(),
        ];
        if (!empty($this->loggedUserId)) {
            $data = array_merge($data, ['user_id' => $this->loggedUserId]);
        }
        $this->db->insert($this->tables->log, $data)->execute();
    }

    protected function handleIp()
    {
        if (isset($this->server['HTTP_ORIGINAL_IP']) && !empty($this->server['HTTP_ORIGINAL_IP'])) {
            $this->userIp = $this->server['HTTP_ORIGINAL_IP'];
            echo 1;
        } elseif (isset($this->server['HTTP_CLIENT_IP']) && !empty($this->server['HTTP_CLIENT_IP'])) {
            $this->userIp = $this->server['HTTP_CLIENT_IP'];
            echo 2;
        } elseif (isset($this->server['HTTP_X_FORWARDED_FOR']) && !empty($this->server['HTTP_X_FORWARDED_FOR'])) {
            $this->userIp = $this->server['HTTP_X_FORWARDED_FOR'];
            echo 3;
        } elseif (isset($this->server['REMOTE_ADDR'])) {
            $this->userIp = $this->server['REMOTE_ADDR'];
        }
    }
}