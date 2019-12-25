<?php


namespace src\model;


use src\core\db\QueryBuilder;

class SearchModel extends CommonModel
{
    protected $data = [];


    public function getEntries()
    {
        $searchedText = $this->validate->set($this->request->query()->get('fSearch'))->filterValue()->get();

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
            ->like($this->tables->entry . '.title', '%' . $searchedText . '%')
            ->like($this->tables->entry . '.content', '%' . $searchedText . '%')
            ->conditions([QueryBuilder::C_OR])
            ->limit($this->limit)
            ->offset($this->offset)
            ->orderBy($this->tables->entry . '.created_at',QueryBuilder::ORDER_DESC)
            ->getAll();

        $totalAmount = count($this->db->select([
            $this->tables->entry . '.id'
        ])
            ->from($this->tables->entry)
            ->leftJoin($this->tables->entry, 'user_id', $this->tables->user, 'id')
            ->leftJoin($this->tables->entry, 'category_id', $this->tables->category, 'id')
            ->leftJoin($this->tables->entry, 'gallery_id', $this->tables->image, 'gallery_id')
            ->like($this->tables->entry . '.title', '%' . $searchedText . '%')
            ->like($this->tables->entry . '.content', '%' . $searchedText . '%')
            ->conditions([QueryBuilder::C_OR])
            ->orderBy($this->tables->entry . '.created_at',QueryBuilder::ORDER_DESC)
            ->getAll());

        $this->data[self::DATA_IMAGES_PATH] = '..//public_html/upload/gallery/';
        $this->data[self::DATA_LABEL_PAGINATOR] = $this->paginator->setUrl('index.php?page=search&fSearch=' . $searchedText . '&')
            ->setParamName('pid')
            ->setAmountTotal($totalAmount)
            ->setAmountPerPage($this->limit)
            ->setActivePage($this->activePage)
            ->getHtml();
        return $this;

    }

}