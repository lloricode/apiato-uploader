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

class UploaderTask extends Task
{
    protected $repository;

    public function __construct(UploaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(UploaderContract $model, UploadedFile $file, string $label = null)
    {
        $modelRules = $model->uploaderRules();

        if ($modelRules->maxSize < $file->getClientSize()) {
            throw new ValidationFailedException('Max file size allowed is ' . formatBytesUnits($modelRules->maxSize));
        }

        $filePath = $this->_storagePath($model);

        $pathToSave = Storage::disk($modelRules->isStorage ? 'local' : 'public')->put($filePath, $file);

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
                'is_storage' => $modelRules->isStorage,
                'bytes' => $file->getClientSize(),
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }

    private function _storagePath($model)
    {
        $modelclass = strtolower(get_class($model));

        $modelClassArray = explode('\\', $modelclass);

        return Uploader::PATH_FOLDER . '/' . $modelClassArray[count($modelClassArray)-1] . '/' . md5($model->id);
    }
}
