<?php


namespace admin\src\model;


use src\core\helper\Helper;
use src\model\CommonModel;

class EntryModel extends CommonModel
{
    protected $data = [];
    protected $title;
    protected $content;
    protected $author;
    protected $category;
    protected $status;
    protected $files;
    protected $userId;
    public const ENTRY_GALLERY_NAME = 'Entry';

    public function verifyInsertData(): bool
    {
        $this->title = $this->validate->set($this->request->post()->get('fTitle'), 'Title')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $this->content = $this->validate->set($this->request->post()->get('fContent'), 'Content')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $this->category = $this->validate->set($this->request->post()->get('fCategory'), 'Category')
            ->filterValue()
            ->checkIfEmpty()
            ->checkIfNumeric()
            ->get();
        $this->status = $this->validate->set($this->request->post()->get('fStatus'), 'Status')
            ->filterValue()
            ->checkIfEmpty()
            ->checkIfNumeric()
            ->get();
        $this->userId = $this->validate->set(($this->session->get(self::USER_LOG_SES_NAME))[0], 'User ID')
            ->filterValue()
            ->checkIfEmpty()
            ->checkIfNumeric()
            ->get();
        $this->files = $this->fileValidate->setFile($this->request->files()->get('fFiles'))
            ->setMaxFileSize($this->configContainer['file']['maxFileSize'])
            ->setExtensions()
            ->verifyFiles()
            ->get();
        $errors = array_merge($this->validate->getErrors(), $this->fileValidate->getErrors());
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
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

    public function insertItem()
    {
        $this->data[self::ACTION_INSERTED] = false;
        if ($this->verifyInsertData()) {
            if ($this->insert()) {
                $this->data[self::ACTION_INSERTED] = true;
            }
        }
        return $this;
    }

    protected function insert(): bool
    {
        $path = '..' . $this->configContainer['blog']['galleryPath'];
        try {
            $this->db->beginTransactions();
            $data = [
                'name' => self::ENTRY_GALLERY_NAME,
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
                'status' => $this->status,
                'title' => $this->title,
                'content' => $this->content,
                'user_id' => $this->userId,
                'gallery_id' => $idGallery,
                'tag_id' => $idTag,
                'category_id' => $this->category,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now(),
            ];
            $this->db->insert($this->tables->entry, $data)->execute();
            foreach ($this->files as $file) {
                $data = [
                    'file_name' => $file['name'],
                    'file_size' => $file['size'],
                    'file_type' => $file['fullType'],
                    'status' => self::STATUS_ACTIVE,
                    'ext' => $file['ext'],
                    'gallery_id' => $idGallery,
                    'created_at' => Helper::now(),
                    'updated_at' => Helper::now()
                ];
                $this->db->insert($this->tables->image, $data)->execute();
                $imageId = $this->db->getLastInsertId();
                $destination = $path . $imageId . '.' . $file['ext'];
                if (!move_uploaded_file($file['tmpName'], $destination)) {
                    throw new \Exception('Cant move file');
                };
            }
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
            'nick',
            $this->tables->entry . '.category_id'
        ])->from($this->tables->entry)
            ->leftJoin($this->tables->entry, 'category_id', $this->tables->category, 'id')
            ->leftJoin($this->tables->entry, 'user_id', $this->tables->user, 'id')
            ->where($this->tables->entry . '.id', '=', $id)
            ->getOne();
        return $this;
    }

    protected function update(): bool
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $path = '..' . $this->configContainer['blog']['galleryPath'];
        $this->db->beginTransactions();
        try {
            //update entry data
            $data = [
                'title' => $this->title,
                'content' => $this->content,
                'status' => $this->status,
                'category_id' => $this->category,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now(),
            ];
            $this->db->update($this->tables->entry, $data)->where('id', '=', $id)->execute();

            //delete files
            $galleryId = ($this->db->select('gallery_id')->from($this->tables->entry)->where('id', '=', $id)->getOne())['gallery_id'];
            $images = $this->db->select(['id', 'ext'])->from($this->tables->image)->where('gallery_id', '=', $galleryId)->getAll();
            foreach ($images as $image) {
                $destination = $path . $image['id'] . '.' . $image['ext'];
                if (!unlink($destination)) {
                    throw new \Exception('Cant delete file');
                }
            }
            $this->db->delete()->from($this->tables->image)->where('gallery_id', '=', $id)->execute();

            //upload new file
            foreach ($this->files as $file) {
                $data = [
                    'file_name' => $file['name'],
                    'file_size' => $file['size'],
                    'file_type' => $file['fullType'],
                    'status' => self::STATUS_ACTIVE,
                    'ext' => $file['ext'],
                    'gallery_id' => $galleryId,
                    'created_at' => Helper::now(),
                    'updated_at' => Helper::now()
                ];
                $this->db->insert($this->tables->image, $data)->execute();
                $imageId = $this->db->getLastInsertId();
                $destination = $path . $imageId . '.' . $file['ext'];
                if (!move_uploaded_file($file['tmpName'], $destination)) {
                    throw new \Exception('Cant move file');
                };
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
        return true;
    }

    public function deleteItem()
    {
        $this->data[self::ACTION_DELETED] = false;
        if ($this->delete()) {
            $this->data[self::ACTION_DELETED] = true;
        }
        return $this;
    }

    protected function delete(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        return $this->db->delete()->from($this->tables->entry)->where('id', '=', $id)->execute();
    }
}