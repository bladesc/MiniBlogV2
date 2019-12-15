<?php


namespace admin\src\model;


use src\model\CommonModel;

class SettingsModel extends CommonModel
{
    protected $data = [];

    protected $title;
    protected $description;
    protected $metaTags;

    public function verifyInsertData(): bool
    {
        $this->title = $this->validate->set($this->request->post()->get('fTitle'), 'Tytul')
            ->filterValue()
            ->validateText(0, 255)
            ->get();
        $this->description = $this->validate->set($this->request->post()->get('fDescription'), 'Description')
            ->filterValue()
            ->validateText(0, 255)
            ->get();
        $this->description = $this->validate->set($this->request->post()->get('fMetaTags'), 'Meta tagi')
            ->filterValue()
            ->validateText(0, 255)
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
    }

    public function getSettings()
    {
        $this->data['settings'] = $this->db->select('*')->from($this->tables->setting)->getAll();
        return $this;
    }

    public function getSetting()
    {
        $this->data['settings'] = $this->db->select('*')->from($this->tables->setting)->getOne();
        return $this;
    }

    public function updateItem()
    {
        $this->data[self::ACTION_UPDATED] = false;
        if ($this->verifyInsertData()) {
            if ($this->update()) {
                $this->data[self::ACTION_UPDATED] = true;
            }
        }
        return $this;
    }

    protected function update(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'meta_tags' => $this->metaTags
        ];
        return $this->db->update($this->tables->setting, $data)->where('id', '=', $id)->execute();
    }
}