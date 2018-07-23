<?php

namespace App\Containers\Uploader\Classes;

class UploaderOptions
{
    public $maxSize;
    public $isStorage;
    public $fileNamePrefix;


    public static function create(): self
    {
        return (new static())->reset();
    }

    public function reset(): self
    {
        $this->fileNamePrefix = 'file-';
        $this->isStorage = true;
        $this->maxSize = 20000000;  // 20 mb in byte decimal

        return $this;
    }

    public function fileNamePrefix(string $fileNamePrefix): self
    {
        $this->fileNamePrefix = $fileNamePrefix;
        return $this;
    }

    public function isStorage(bool $isStorage): self
    {
        $this->isStorage = $isStorage;
        return $this;
    }
    
    public function maxSize(int $maxSize): self
    {
        $this->maxSize = $maxSize;
        return $this;
    }
}
