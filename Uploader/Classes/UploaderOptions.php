<?php

namespace App\Containers\Uploader\Classes;

use App\Ship\Exceptions\InternalErrorException;

class UploaderOptions
{
    public $maxSize;
    public $storageDriver;
    public $fileNamePrefix;


    public static function create(): self
    {
        return (new static())->reset();
    }

    public function reset(): self
    {
        $this->fileNamePrefix = 'file';
        $this->storageDriver = config('filesystems.default');
        $this->maxSize = 20000000;  // 20 mb in byte decimal

        return $this;
    }

    public function fileNamePrefix(string $fileNamePrefix): self
    {
        $this->fileNamePrefix = $fileNamePrefix;
        return $this;
    }

    /**
     * Must be existed in Config filesystems's disk
     *
     * @param boolean $storageDriver
     * @return self
     */
    public function storageDriver(string $storageDriver): self
    {
        $drivers = array_keys(config('filesystems.disks'));

        throw_if(!in_array($storageDriver, $drivers), InternalErrorException::class, 'Invalid storage parameter in ' . get_class($this) . '->storageDriver($storageDriver)');

        $this->storageDriver = $storageDriver;
        return $this;
    }
    
    public function maxSize(int $maxSize): self
    {
        $this->maxSize = $maxSize;
        return $this;
    }
}
