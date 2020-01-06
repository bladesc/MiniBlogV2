<?php


namespace src\model;


use src\core\db\QueryBuilder;
use src\core\general\Communicate;
use src\core\request\Request;
use src\session\Session;

class CommonModel extends BaseModel
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;
    public const TYPE_ENTRY = 1;
    public const TYPE_GALLERY = 2;

    public const USER_LOG_SES_NAME = 'userLoginSes';

    public const ACTION_INSERTED = 'inserted';
    public const ACTION_NOT_INSERTED = 'notinserted';
    public const ACTION_UPDATED = 'updated';
    public const ACTION_NOT_UPDATED = 'notupdated';
    public const ACTION_DELETED = 'deleted';
    public const ACTION_NOT_DELETED = 'notdeleted';
    public const ACTION_LOGGED = 'logged';
    public const ACTION_NOT_LOGGED = 'notlogged';
    public const ACTION_REMINDED = 'reminded';
    public const ACTION_NOT_REMINDED = 'notreminded';
    public const ACTION_LOGOUT = 'logout';
    public const ACTION_NOT_LOGOUT = 'notlogout';

    public const ERROR_LABEL = 'errors';

    public const DATA_LABEL_ENTRIES = 'entries';
    public const DATA_LABEL_PAGES = 'pages';
    public const DATA_LABEL_LOGIN = 'login';
    public const DATA_IMAGES_PATH = 'imagePath';
    public const DATA_LABEL_LOGGED_IN = 'loggedIn';
    public const DATA_LABEL_CATEGORIES = 'categories';
    public const DATA_LABEL_PAGINATOR = 'paginator';
    public const DATA_LABEL_COMMENTS = 'comments';
    public const DATA_LABEL_PAGE = 'page';
    public const DATA_LABEL_ROLE = 'role';

    public const LANG = 'lang';

    protected $offset = 0;
    protected $limit = 0;
    protected $activePage = 0;
    protected $amountPerPage = 0;

    public const GALLERY_PATTERN = '/(<%gallery=)(.+)(%>)/';

    public function __construct(Request $request, bool $installationStatus = true)
    {
        parent::__construct($request, $installationStatus);
        $this->preparePaginatorData();
    }

    public function preparePaginatorData()
    {
        $this->limit = $this->configContainer['entries']['amountPerPage'];
        if($this->request->query()->has('pid')) {
            $id = $this->request->query()->get('pid');
            if (is_numeric($id)) {
                $this->activePage = (int) $this->request->query()->get('pid');
            }
            $this->offset = ((int) $this->request->query()->get('pid')) * $this->configContainer['entries']['amountPerPage'];
        }
    }

    public function getMenuData()
    {
        return $this->db->select("*")->from($this->tables->user)->getAll();
    }

    public function getCommunicateData()
    {
        $pCommunicate = $this->session->get(Communicate::C_POSITIVE);
        $nCommunicate = $this->session->get(Communicate::C_NEGATIVE);
        if (!empty($pCommunicate)) {
            $this->data[Communicate::C_POSITIVE] = $pCommunicate;
            $this->session->remove(Communicate::C_POSITIVE);
        }
        if (!empty($nCommunicate)) {
            $this->data[Communicate::C_NEGATIVE] = $nCommunicate;
            $this->session->remove(Communicate::C_NEGATIVE);
        }
    }

    public function getBaseData()
    {
        $this->getCommunicateData();
    }

    public function getData(): array
    {
        $this->getBaseData();
        $this->getLoginData();
        $this->getPages();
        return $this->data;
    }

    public function getLoginData()
    {
        if (!empty(($this->session->get(CommonModel::USER_LOG_SES_NAME))[0])) {
            $this->data[self::DATA_LABEL_LOGGED_IN] = true;
            $userRole = $this->db->select(['role_id'])
                ->from($this->tables->user)
                ->where('id', '=', ($this->session->get(CommonModel::USER_LOG_SES_NAME))[0])
                ->getOne();
            $this->data[self::DATA_LABEL_ROLE] = $userRole['role_id'];
            $this->data[self::DATA_LABEL_LOGIN] = $this->session->get(CommonModel::USER_LOG_SES_NAME);
        } else {
            $this->data[self::DATA_LABEL_LOGGED_IN] = false;
        }
    }

    protected function checkIfUserExists(): array
    {
        $user = $this->db->select('*')->from($this->tables->user)->where('email', '=', $this->email)->getAll();
        return $user;
    }

    public function getPages()
    {
        $this->data[self::DATA_LABEL_PAGES] = $this->db->select(['name', 'url'])
            ->from($this->tables->page)
            ->where('status', '=', self::STATUS_ACTIVE)
            ->getAll();
        return $this;
    }

    public function getCategories()
    {
        /*$this->data[self::DATA_LABEL_CATEGORIES] = $this->db->select([
            $this->tables->category . '.id',
            'name',
            "COUNT('title') as entry_amount"])
            ->from($this->tables->category)
            ->leftJoin($this->tables->category, 'id', $this->tables->entry, 'category_id')
            ->where($this->tables->category . '.status', '=', self::STATUS_ACTIVE)
            ->groupBy('name')
            ->orderBy('name', QueryBuilder::ORDER_ASC)
            ->getAll();*/

        $this->data[self::DATA_LABEL_CATEGORIES] = $this->db->rawSql("SELECT mb_category.id, name, COUNT(title) as entry_amount 
                FROM mb_category 
                LEFT JOIN mb_entry ON mb_category.id=mb_entry.category_id 
                WHERE mb_category.status=1 
                GROUP BY name ORDER BY name ASC")
            ->getAll();
        return $this;
    }
}