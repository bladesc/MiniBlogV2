<?php


namespace src\model;


class CmsModel extends CommonModel
{
    protected $data = [];
    protected $pages = [];

    public function getCmsPages()
    {
        $pages = $this->db->select(['name'])
            ->from($this->tables->page)
            ->where('status', '=', self::STATUS_ACTIVE)
            ->getAll();
        foreach ($pages as $page) {
            $this->pages[] = $page['name'];
        }
        return $this->pages;
    }

    public function getPage(string $page)
    {
        $page = $this->validate->set($page)->filterValue()->get();
        $this->data[self::DATA_LABEL_PAGE] = $this->db->select(['name', 'url', 'title', 'content', 'tag'])->from($this->tables->page)
            ->leftJoin($this->tables->page, 'page_seo_id', $this->tables->page_seo, 'id')
            ->where('name', '=', $page)
            ->getOne();
        return $this;
    }
}