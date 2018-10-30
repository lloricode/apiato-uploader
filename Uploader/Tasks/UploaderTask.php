<?php

namespace App\Containers\Uploader\Tasks;

use App\Containers\Uploader\Models\Uploader;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Http\UploadedFile;
use Lloricode\LaravelUploader\Contract\UploaderContract;

class UploaderTask extends Task
{
    public function run(UploaderContract $model, UploadedFile $file, string $label = null): Uploader
    {
        return $model->uploadFile($file, $label);
    }
}
