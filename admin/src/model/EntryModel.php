<?php


namespace admin\src\model;


use src\core\helper\Helper;
use src\model\CommonModel;

class EntryModel extends CommonModel
{
    protected $data = [];

    public function verifyInsertData(): bool
    {
        $cTitle = $this->request->post()->get('cTitle');
        $cContent = $this->request->post()->get('cContent');
        $cAuthor = $this->request->post()->get('cAuthor');
        $cCategory = $this->request->post()->get('cCategory');
        $cStatus = $this->request->post()->get('cStatus');
        if (!empty($cTitle) && !empty($cContent) && !empty($cAuthor) && (!empty($cCategory) || $cCategory == 0)) {
            if (!$this->validator->validateText($cTitle, 1, 255)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
                return false;
            }
            if (!$this->validator->validateText($cContent, 1, 2000)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
                return false;
            }
            if (!is_numeric($cAuthor)) {
                $this->data['errors'][] = 'Zla nazwa, wartosc autor';
                return false;
            }
            if (!is_numeric($cCategory)) {
                $this->data['errors'][] = 'Zla wartosc - kategoria';
                return false;
            }
            if (!is_numeric($cStatus)) {
                $this->data['errors'][] = 'Zla wartosc - status';
                return false;
            }
        } else {
            $this->data['errors'][] = 'Nie wypelniles wszystkich pol';
            return false;
        }
        return true;
    }

    public function verifyUpdateData(): bool
    {
        $cTitle = $this->request->post()->get('cTitle');
        $cContent = $this->request->post()->get('cContent');
        $cAuthor = $this->request->post()->get('cAuthor');
        $cCategory = $this->request->post()->get('cCategory');
        $cStatus = $this->request->post()->get('cStatus');
        if (!empty($cTitle) && !empty($cContent) && !empty($cAuthor) && (!empty($cCategory) || $cCategory == 0)) {
            if (!$this->validator->validateText($cTitle, 1, 255)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
                return false;
            }
            if (!$this->validator->validateText($cContent, 1, 2000)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
                return false;
            }
            if (!is_numeric($cAuthor)) {
                $this->data['errors'][] = 'Zla nazwa, wartosc autor';
                return false;
            }
            if (!is_numeric($cCategory)) {
                $this->data['errors'][] = 'Zla wartosc - kategoria';
                return false;
            }
            if (!is_numeric($cStatus)) {
                $this->data['errors'][] = 'Zla wartosc - status';
                return false;
            }
        } else {
            $this->data['errors'][] = 'Nie wypelniles wszystkich pol';
            return false;
        }
        return true;
    }

    public function updateEntry()
    {
        $this->data['entryUpdated'] = false;
        if ($this->verifyUpdateData()) {
            if ($this->updateEntryToDb()) {
                $this->data['entryUpdated'] = true;
            }
        }
        return $this;
    }

    public function getEntries()
    {
        $this->data['entries'] = $this->db->select([
            $this->tables->entry . '.id',
            $this->tables->entry . '.created_at',
            $this->tables->entry . '.updated_at',
            $this->tables->entry . '.status',
            'title',
            'content',
            'name',
            'nick',
            'gallery_id'
        ])
            ->from($this->tables->entry)
            ->leftJoin($this->tables->entry, 'category_id', $this->tables->category, 'id')
            ->leftJoin($this->tables->entry, 'user_id', $this->tables->user, 'id')
            ->getAll();
        return $this;
    }

    public function getCategories()
    {
        $this->data['categories'] = $this->db->select('*')
            ->from($this->tables->category)
            ->where('status', '=', self::STATUS_ACTIVE)
            ->getAll();
        return $this;
    }

    public function addEntry()
    {
        $this->data['entryInserted'] = false;
        if ($this->verifyInsertData()) {
            if ($this->addEntryToDb()) {
                $this->data['entryInserted'] = true;
            }
        }
        return $this;
    }

    protected function addEntryToDb(): bool
    {
        $cTitle = $this->validator->filterValue($this->request->post()->get('cTitle'));
        $cContent = $this->validator->filterValue($this->request->post()->get('cContent'));
        $cAuthor = ($this->session->get(self::USER_LOG_SES_NAME))[0];
        $cCategory = $this->validator->filterValue($this->request->post()->get('cCategory'));
        $cStatus = $this->validator->filterValue($this->request->post()->get('cStatus'));

        try {
            $this->db->beginTransactions();

            $data = [
                'status' => self::STATUS_ACTIVE,
                'type' => self::TYPE_ENTRY,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now(),
            ];
            $this->db->insert($this->tables->gallery, $data)->execute();
            $idGallery = $this->db->getLastInsertId();
            $data = [
                'name' => ''
            ];
            $this->db->insert($this->tables->tag, $data)->execute();
            $idTag = $this->db->getLastInsertId();

            $data = [
                'status' => $cStatus,
                'title' => $cTitle,
                'content' => $cContent,
                'user_id' => $cAuthor,
                'gallery_id' => $idGallery,
                'tag_id' => $idTag,
                'category_id' => $cCategory,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now(),
            ];
            $this->db->insert($this->tables->entry, $data)->execute();
            $this->db->commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
            return false;
        }

        return true;
    }

    public function getEntry(): object
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['entries'] = $this->db->select([
                $this->tables->entry . '.id',
                $this->tables->entry . '.created_at',
                'title',
                'content',
                $this->tables->entry . '.status',
                'name',
                'nick'
            ])->from($this->tables->entry)
            ->leftJoin($this->tables->entry, 'category_id', $this->tables->category, 'id')
            ->leftJoin($this->tables->entry, 'user_id', $this->tables->user, 'id')
            ->where($this->tables->entry . '.id', '=', $id)
            ->getOne();
        return $this;
    }

    protected function updateEntryToDb(): bool
    {
        $cTitle = $this->validator->filterValue($this->request->post()->get('cTitle'));
        $cContent = $this->validator->filterValue($this->request->post()->get('cContent'));
        $cCategory = $this->validator->filterValue($this->request->post()->get('cCategory'));
        $cStatus = $this->validator->filterValue($this->request->post()->get('cStatus'));
        $id = $this->validator->filterValue($this->request->post()->get('cId'));
        $data = [
            'title' => $cTitle,
            'content' => $cContent,
            'status' => $cStatus,
            'category_id' => $cCategory,
            'created_at' => Helper::now(),
            'updated_at' => Helper::now(),
        ];
        return $this->db->update($this->tables->entry, $data)->where('id', '=', $id)->execute();
    }

    public function deleteEntry()
    {
        $this->data['entryDeleted'] = false;
        if ($this->deleteEntryToDb()) {
            $this->data['entryDeleted'] = true;
        }
        return $this;
    }

    protected function deleteEntryToDb(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('cId'));
        return $this->db->delete()->from($this->tables->entry)->where('id', '=', $id)->execute();
    }
}