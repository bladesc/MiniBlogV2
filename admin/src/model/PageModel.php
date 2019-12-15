<?php


namespace admin\src\model;


use src\core\helper\Helper;
use src\model\CommonModel;

class PageModel extends CommonModel
{
    protected $name;
    protected $url;
    protected $status;
    protected $content;
    protected $seoTitle;
    protected $seoDescription;
    protected $seoTags;

    protected $data = [];

    public function verifyAddItemData(): bool
    {
        $this->name = $this->validate->set($this->request->post()->get('fName'), 'Name')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $this->url = $this->validate->set($this->request->post()->get('fUrl'), 'Url')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $this->status = $this->validate->set($this->request->post()->get('fStatus'), 'Status')
            ->filterValue()
            ->checkIfEmpty()
            ->checkIfNumeric()
            ->get();
        $this->content = $this->validate->set($this->request->post()->get('fContent'), 'Content')
            ->checkIfEmpty()
            ->validateText(4, 2000)
            ->get();
        $this->seoTitle = $this->validate->set($this->request->post()->get('fTitle'), 'Content')
            ->filterValue()
            ->validateText(0, 255)
            ->get();
        $this->seoDescription = $this->validate->set($this->request->post()->get('fDescription'), 'Content')
            ->filterValue()
            ->validateText(0, 255)
            ->get();
        $this->seoTags = $this->validate->set($this->request->post()->get('fTags'), 'Tag')
            ->filterValue()
            ->validateText(0, 255)
            ->get();

        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data['errors'] = $errors;
            return false;
        }
        return true;
    }

    public function addItem()
    {
        $this->data[self::ACTION_INSERTED] = false;
        if ($this->verifyAddItemData()) {
            if ($this->insert()) {
                $this->data[self::ACTION_INSERTED] = true;
            }
        }
        return $this;
    }

    public function updateItem()
    {
        $this->data[self::ACTION_UPDATED] = false;
        if ($this->verifyAddItemData()) {
            if ($this->update()) {
                $this->data[self::ACTION_UPDATED] = true;
            }
        }
        return $this;
    }

    public function deleteItem()
    {
        $this->data[self::ACTION_DELETED] = false;
        if ($this->delete()) {
            $this->data[self::ACTION_DELETED] = true;
        }
        return $this;
    }


    public function insert()
    {
        $this->db->beginTransactions();
        try {
            $data = [
                'title' => $this->seoTitle,
                'description' => $this->seoDescription,
                'tag' => $this->seoTags
            ];
            $this->db->insert($this->tables->page_seo, $data)->execute();
            $seoId = $this->db->getLastInsertId();
            $data = [
                'name' => $this->name,
                'url' => $this->url,
                'content' => $this->content,
                'status' => $this->status,
                'page_seo_id' => $seoId,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now()
            ];
            $this->db->insert($this->tables->page, $data)->execute();
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function update()
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->db->beginTransactions();
        try {
            $pageSeoId = ($this->db->select(['page_seo_id'])
                ->from($this->tables->page)
                ->where('id', '=', $id)
                ->getAll())[0]['page_seo_id'];
            $data = [
                'title' => $this->seoTitle,
                'description' => $this->seoDescription,
                'tag' => $this->seoTags
            ];
            $this->db->update($this->tables->page_seo, $data)
                ->where('id', '=', $pageSeoId)
                ->execute();
            $data = [
                'name' => $this->name,
                'url' => $this->url,
                'content' => $this->content,
                'status' => $this->status,
                'updated_at' => Helper::now()
            ];
            $this->db->update($this->tables->page, $data)
                ->where('id', '=', $id)
                ->execute();
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
            return false;
        }
    }

    public function delete()
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $pageSeoId = ($this->db->select(['page_seo_id'])
            ->from($this->tables->page)
            ->where('id', '=', $id)
            ->getAll())[0]['page_seo_id'];
        return $this->db->delete()->from($this->tables->page_seo)->where('id', '=', $pageSeoId)->execute();
    }

    public function getPage()
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['pages'] = $this->db->select([
            $this->tables->page . '.id',
            'name',
            'url',
            'content',
            'status',
            'created_at',
            'updated_at',
            'title',
            'description',
            'tag'
        ])->from($this->tables->page)
            ->leftJoin($this->tables->page, 'page_seo_id', $this->tables->page_seo, 'id')
            ->where($this->tables->page . '.id', '=', $id)->getOne();
        return $this;
    }

    public function getPages()
    {
        $this->data['pages'] = $this->db->select([
            $this->tables->page . '.id',
            'name',
            'url',
            'content',
            'status',
            'created_at',
            'updated_at',
            'title',
            'description',
            'tag'
        ])
            ->from($this->tables->page)
            ->leftJoin($this->tables->page, 'page_seo_id', $this->tables->page_seo, 'id')
            ->getAll();
        return $this;
    }
}