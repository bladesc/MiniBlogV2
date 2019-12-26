<?php


namespace src\model;


use src\core\db\QueryBuilder;

class IndexModel extends CommonModel
{
    protected $data = [];

    public function logout()
    {
        $this->data[CommonModel::ACTION_LOGOUT] = false;
        if ($this->session->remove(self::USER_LOG_SES_NAME)) {
            $this->data[CommonModel::ACTION_LOGOUT] = true;
        }
        return $this;
    }

    public function setLanguage()
    {
        $lang = strtolower($this->validate->set($this->request->query()->get('lang'))
            ->filterValue()
            ->get());
        $this->session->change(self::LANG, $lang);
        return $this;
    }

    public function getEntries()
    {
        $totalAmount = ($this->db->select(["count('id') as amount"])->from($this->tables->entry)->getOne())['amount'];
        $this->data[self::DATA_LABEL_ENTRIES] = $this->db->select([
            $this->tables->entry . '.id',
            'title',
            'content',
            $this->tables->entry . '.created_at',
            'nick',
            'name',
            'file_name',
            'ext',
            $this->tables->image . '.id as photo_id'
        ])
            ->from($this->tables->entry)
            ->leftJoin($this->tables->entry, 'user_id', $this->tables->user, 'id')
            ->leftJoin($this->tables->entry, 'category_id', $this->tables->category, 'id')
            ->leftJoin($this->tables->entry, 'gallery_id', $this->tables->image, 'gallery_id')
            ->limit($this->limit)
            ->offset($this->offset)
            ->orderBy($this->tables->entry . '.created_at',QueryBuilder::ORDER_DESC)
            ->getAll();
        $this->data[self::DATA_IMAGES_PATH] = '..//public_html/upload/gallery/';
        $this->data[self::DATA_LABEL_PAGINATOR] = $this->paginator->setUrl('index.php?')
            ->setParamName('pid')
            ->setAmountTotal($totalAmount)
            ->setAmountPerPage($this->limit)
            ->setActivePage($this->activePage)
            ->getHtml();
        return $this;
    }

}