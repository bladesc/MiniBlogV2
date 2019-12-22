<?php


namespace src\core\validation;


class FileValidate
{
    protected $files = [];
    protected $formatedFiles = [];
    protected $extensions = [];
    protected $maxFileSize;
    protected $errors = [];

    public const FORMAT_JPG = 'jpg';
    public const FORMAT_JPEG = 'jpeg';
    public const FORMAT_PNG = 'png';
    public const FORMAT_GIF = 'gif';

    public const DEFAULT_FILE_SIZE = 2048; //2MB

    protected $validate;

    public function __construct(Validate $validate)
    {
        $this->validate = $validate;
    }


    public function setFiles($files)
    {
        $this->files = $files;
        return $this;
    }

    public function setFile($file)
    {
        foreach ($file as $key => $value) {
            $this->files[$key][] = $value;
        }
        return $this;
    }

    public function setExtensions(array $extensions = [self::FORMAT_GIF, self::FORMAT_JPEG, self::FORMAT_JPG, self::FORMAT_PNG])
    {
        $this->extensions = $extensions;
        return $this;
    }

    public function setMaxFileSize(int $kbytes = self::DEFAULT_FILE_SIZE)
    {
        $this->maxFileSize = $kbytes * 1024;
        return $this;
    }

    protected function formatFilesArr()
    {
        $itemAmount = count($this->files['name']);
        $formattedFiles = [];
        if (!empty($this->files['name'][0])) {
            for ($i = 0; $i < $itemAmount; $i++) {
                $formattedFiles[$i]['fullName'] = $this->files['name'][$i];
                $nameArr = explode('.', $this->files['name'][$i]);
                $formattedFiles[$i]['name'] = $nameArr[0];
                $formattedFiles[$i]['ext'] = $nameArr[1];
                $formattedFiles[$i]['fullType'] = $this->files['type'][$i];
                $typeArr = explode('/', $this->files['type'][$i]);
                $formattedFiles[$i]['fileType'] = $typeArr[0];
                $formattedFiles[$i]['type'] = $typeArr[1];
                $formattedFiles[$i]['error'] = $this->files['error'][$i];
                $formattedFiles[$i]['size'] = $this->files['size'][$i];
                $formattedFiles[$i]['tmpName'] = $this->files['tmp_name'][$i];
            }
        }
        $this->formatedFiles = $formattedFiles;
    }

    public function verifyFiles()
    {
        $this->formatFilesArr();
        foreach ($this->formatedFiles as $file) {
            if (!in_array($file['ext'], $this->extensions)) {
                $this->errors[] = 'Bad format for file:' . $file['fullName'];
            }
            if ($file['size'] > $this->maxFileSize) {
                $this->errors[] = 'Too much file size:' . $file['size'] . '. Max file size: ' . $this->maxFileSize;
            }
        }
        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function get()
    {
        return $this->formatedFiles;
    }

}