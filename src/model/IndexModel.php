<?php


namespace src\model;


class IndexModel extends CommonModel
{
    protected $data = [];
    protected $offset = 0;

    public function logout()
    {
        $this->data[CommonModel::ACTION_LOGOUT] = false;
        if ($this->session->remove(self::USER_LOG_SES_NAME)) {
            $this->data[CommonModel::ACTION_LOGOUT] = true;
        }
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
            ->getAll();
        $this->data[self::DATA_IMAGES_PATH] = '..//public_html/upload/gallery/';
        $this->data[self::DATA_LABEL_PAGINATOR] = $this->paginator->url('index.php?')
            ->paramName('pid')
            ->amountTotal($totalAmount)
            ->amountPerPage($this->limit)
            ->getHtml();
        return $this;
    }

}