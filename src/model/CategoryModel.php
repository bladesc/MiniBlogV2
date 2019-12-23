<?php


namespace src\model;


use src\core\db\QueryBuilder;

class CategoryModel extends CommonModel
{
    protected $data = [];

    public function getEntries()
    {
        $cid = $this->request->query()->query()->get('cid');
        $totalAmount = ($this->db->select(["count('id') as amount"])->from($this->tables->entry)->where($this->tables->entry .'.category_id', '=', $cid)->getOne())['amount'];
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
            ->where($this->tables->entry .'.category_id', '=', $cid)
            ->limit($this->limit)
            ->offset($this->offset)
            ->orderBy($this->tables->entry . '.created_at', QueryBuilder::ORDER_DESC)
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