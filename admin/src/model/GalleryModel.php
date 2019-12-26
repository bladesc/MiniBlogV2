<?php


namespace admin\src\model;


use src\core\helper\Helper;
use src\model\CommonModel;

class GalleryModel extends CommonModel
{
    protected $data = [];
    protected $name;
    protected $status;
    protected $files;

    public function verifyInsertData()
    {
        $this->name = $this->validate->set($this->request->post()->get('fName'), $this->translations->pl['tableName'])
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $this->status = $this->validate->set($this->request->post()->get('fStatus'), $this->translations->pl['tableStatus'])
            ->filterValue()
            ->checkIfEmpty()
            ->checkIfNumeric()
            ->get();
        $this->files = $this->fileValidate->setFiles($this->request->files()->get('fFiles'))
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

    public function getGalleries()
    {
        $this->data['galleries'] = $this->db->select('*')->from($this->tables->gallery)->where('type','=',self::TYPE_GALLERY)->getAll();
        return $this;
    }

    public function getGallery()
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['galleries'] = $this->db->select('*')->from($this->tables->gallery)->where('id', '=', $id)->getOne();
        return $this;
    }

    public function getImages()
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['images'] = $this->db->select('*')->from($this->tables->image)->where('gallery_id', '=', $id)->getAll();
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

    public function deleteItem()
    {
        $this->data[self::ACTION_DELETED] = false;
        if ($this->delete()) {
            $this->data[self::ACTION_DELETED] = true;
        }
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

    public function update()
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $path = '..' . $this->configContainer['blog']['galleryPath'];
        $this->db->beginTransactions();
        try {
            $data = [
                'name' => $this->name,
                'status' => $this->status,
                'updated_at' => Helper::now()
            ];
            $this->db->update($this->tables->gallery, $data)->execute();
            $images = $this->db->select(['id','ext'])->from($this->tables->image)->where('gallery_id', '=', $id)->getAll();
            foreach ($images as $image) {
                $destination = $path . $image['id'] . '.' . $image['ext'];
                if(!unlink($destination)) {
                    throw new \Exception('Cant delete file');
                }
            }
            $this->db->delete()->from($this->tables->image)->where('gallery_id', '=', $id)->execute();
            foreach ($this->files as $file) {
                $data = [
                    'file_name' => $file['name'],
                    'file_size' => $file['size'],
                    'file_type' => $file['fullType'],
                    'status' => self::STATUS_ACTIVE,
                    'ext' => $file['ext'],
                    'gallery_id' => $id,
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
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function delete()
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $path = '..' . $this->configContainer['blog']['galleryPath'];
        $this->db->beginTransactions();
        try {
            $images = $this->db->select(['id','ext'])->from($this->tables->image)->where('gallery_id', '=', $id)->getAll();
            foreach ($images as $image) {
                $destination = $path . $image['id'] . '.' . $image['ext'];
                if(file_exists($destination)) {
                    if(!unlink($destination)) {
                        throw new \Exception('Cant delete file');
                    }
                }
            }
            $id = $this->validator->filterValue($this->request->post()->get('fId'));
            $this->db->delete()->from($this->tables->gallery)->where('id', '=', $id)->execute();
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function insert()
    {
        $this->db->beginTransactions();
        $path = '..' . $this->configContainer['blog']['galleryPath'];
        try {
            $data = [
                'name' => $this->name,
                'status' => $this->status,
                'type' => self::TYPE_GALLERY,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now()
            ];
            $this->db->insert($this->tables->gallery, $data)->execute();
            $galleryId = $this->db->getLastInsertId();
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
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
            return false;
        }
    }
}