<?php


namespace src\model;


use src\core\db\QueryBuilder;
use src\core\helper\Helper;

class EntryModel extends CommonModel
{
    protected $data = [];
    protected $comContent;
    protected $comAuthor;
    protected $comEntryId;

    public function verifyInsertData(): bool
    {
        $this->comContent = $this->validate->set($this->request->post()->get('fComment'), $this->translations->pl['entryContent'])
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 10000)
            ->get();
        $this->comAuthor = $this->validate->set($this->request->post()->get('fAuthor'), $this->translations->pl['entryAuthor'])
            ->filterValue()
            ->checkIfNumeric()
            ->get();
        $this->comEntryId = $this->validate->set($this->request->post()->get('fEntryId'), $this->translations->pl['entryId'])
            ->filterValue()
            ->checkIfNumeric()
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
    }

    public function getComments()
    {
        $this->data[self::DATA_LABEL_COMMENTS] = $this->db->select([
            'content',
            $this->tables->comment. '.created_at',
            'nick'
        ])
            ->from($this->tables->comment)
            ->leftJoin($this->tables->comment, 'user_id', $this->tables->user, 'id')
            ->orderBy($this->tables->comment. '.created_at', QueryBuilder::ORDER_DESC)
            ->getAll();
        return $this;
    }

    public function addComment()
    {
        $this->data[self::ACTION_INSERTED] = false;
        if ($this->verifyInsertData()) {
            if ($this->insert()) {
                $this->data[self::ACTION_INSERTED] = true;

            }
        }
        return $this;
    }

    protected function insert()
    {
        $data = [
            'user_id' => $this->comAuthor,
            'content' => $this->comContent,
            'entry_id' => $this->comEntryId,
            'created_at' => Helper::now(),
            'updated_at' => Helper::now()
        ];
        return $this->db->insert($this->tables->comment,$data)->execute();
    }

    public function getEntry()
    {
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
            ->where($this->tables->entry . '.id', '=', $this->request->query()->get('id'))
            ->getAll();
        $this->data[self::DATA_IMAGES_PATH] = '..//public_html/upload/gallery/';

        return $this;
    }
}