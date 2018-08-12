<?php

namespace App\Containers\Uploader\Tasks;

use App\Containers\Uploader\Data\Repositories\UploaderRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Http\UploadedFile;
use App\Containers\Uploader\Contract;
use App\Containers\Uploader\Contract\UploaderContract;
use App\Containers\Uploader\Models\Uploader;
use App\Ship\Exceptions\ValidationFailedException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UploaderTask extends Task
{
    protected $repository;
    private $_fileSystemConfig;

    public function __construct(UploaderRepository $repository)
    {
        $this->repository = $repository;
        $this->_fileSystemConfig = config('filesystems');
    }

    public function run(UploaderContract $model, UploadedFile $file, string $label = null)
    {
        $modelRules = $model->uploaderRules();

        if ($modelRules->maxSize < $file->getClientSize()) {
            throw new ValidationFailedException('Max file size allowed is ' . formatBytesUnits($modelRules->maxSize));
        }
        
        $pathToSave = Storage::disk($modelRules->disk)->put($this->_storagePath($model), $file);
       
        try {
            return $this->repository->create([
                'client_original_name' => $file->getClientOriginalName(),
                'label' => $label,
                'uploaderable_id' => $model->id,
                'uploaderable_type' => get_class($model),
                'user_id' => app()->runningInConsole() ? 1 : auth()->user()->id,
                'content_type' =>  $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $pathToSave,
                'disk' => $modelRules->disk,
                'bytes' => $file->getClientSize(),
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }

    private function _storagePath(UploaderContract $model)
    {
        $modelclass = strtolower(get_class($model));

        $modelClassArray = explode('\\', $modelclass);

        $pathConfig = config('uploader-container.folder_path');

        return Uploader::PATH_FOLDER . '/' . $pathConfig . $modelClassArray[count($modelClassArray)-1] . '/' . md5($model->id);
    }
}
