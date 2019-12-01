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
        if (!empty($cTitle) && !empty($cContent) && !empty($cAuthor)) {
            if (!$this->validator->validateText($cTitle, 1, 255)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
                return false;
            }
            if (!$this->validator->validateText($cContent, 1, 2000)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
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
        if (!empty($cTitle) && !empty($cContent) && !empty($cAuthor)) {
            if (!$this->validator->validateText($cTitle, 1, 255)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
                return false;
            }
            if (!$this->validator->validateText($cContent, 1, 2000)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 255, niedozwolone znaki';
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

    public function getEntries(): object
    {
        $this->data['entries'] = $this->db->select('*')->from($this->tables->entry)->getAll();
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
        $cAuthor = $this->validator->filterValue($this->request->post()->get('cAuthor'));
        $data = [
            'title' => $cTitle,
            'content' => $cContent,
            'iduser' => $cAuthor,
            'created_at' => Helper::now(),
            'updated_at' => Helper::now(),
        ];
        return $this->db->insert($this->tables->entry, $data)->execute();
    }

    public function getEntry(): object
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['entries'] = $this->db->select('*')->from($this->tables->entry)->where('id', '=', $id)->getOne();
        return $this;
    }

    protected function updateEntryToDb(): bool
    {
        $cTitle = $this->validator->filterValue($this->request->post()->get('cTitle'));
        $cContent = $this->validator->filterValue($this->request->post()->get('cContent'));
        $cAuthor = $this->validator->filterValue($this->request->post()->get('cAuthor'));
        $id = $this->validator->filterValue($this->request->post()->get('cId'));
        $data = [
            'title' => $cTitle,
            'content' => $cContent,
            'iduser' => $cAuthor,
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