<?php

namespace App\Containers\Uploader\Tasks;

use App\Containers\Uploader\Data\Repositories\UploaderRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use App\Containers\Uploader\Contract;
use App\Containers\Uploader\Contract\UploaderContract;
use File;
use App\Containers\Uploader\Models\Uploader;
use App\Ship\Exceptions\ValidationFailedException;

class UploaderTask extends Task
{
    protected $repository;
    private $_fileSystem;

    public function __construct(UploaderRepository $repository)
    {
        $this->_fileSystem = new Filesystem;
        $this->repository = $repository;
    }

    public function run(UploaderContract $model, UploadedFile $file, string $label = null)
    {
        $modelRules = $model->uploaderRules();

        if ($modelRules->maxSize < $file->getClientSize()) {
            throw new ValidationFailedException('Max file size allowed is ' . formatBytesUnits($modelRules->maxSize));
        }

        $fileName = md5(now()->format('Ymdhis').$model->id);
        $filePath = $this->_storagePath($modelRules->isStorage, $model). '/'. $fileName;

        $this->_fileSystem->copy($file->getRealPath(), $filePath);

        $pathToSave = $this->_removeLocalPath($modelRules->isStorage, $filePath);

        try {
            return $this->repository->create([
                'label' => $label,
                'uploaderable_id' => $model->id,
                'uploaderable_type' => get_class($model),
                'user_id' => app()->runningInConsole() ? 1 : auth()->user()->id,
                'content_type' =>  $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $pathToSave,
                'is_storage' => $modelRules->isStorage,
                'bytes' => $file->getClientSize(),
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }

    private function _removeLocalPath($isStorage, $path)
    {
        $pathToRemove = $isStorage ? storage_path() : public_path();

        return str_replace($pathToRemove, '', $path);
    }

    private function _storagePath($isStorage, $model)
    {
        $modelclass = strtolower(get_class($model));

        $modelClassArray = explode('\\', $modelclass);

        $folder = Uploader::PATH_FOLDER;
        $storage =  $isStorage ? storage_path("app/$folder/") : public_path("assets/$folder/");
        $storage .= $modelClassArray[count($modelClassArray)-1];
        $storage .= '/' . md5($model->id);

        return $this->_checkPathExist($storage);
    }

    private function _checkPathExist($path)
    {
        if (! file_exists($path)) {
            File::makeDirectory($path, 0755, $recursive = true);
        }
        return $path;
    }
}
