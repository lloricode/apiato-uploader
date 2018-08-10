<?php

namespace App\Containers\Uploader\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Storage;
use App\Containers\Uploader\Models\Uploader;

class DownloadTask extends Task
{
    public function run(Uploader $uploader)
    {
        $uploderable = $uploader->uploaderable;
        $uploderableRules = $uploderable->uploaderRules();

        $label = $uploader->label?:$uploderableRules->fileNamePrefix . now()->format('Ymd_Hi');

        return Storage::disk($uploader->storage_driver)->download(
            $uploader->path,
            $label  . '.' . $uploader->extension,
            [
                'Content-Type: ' . $uploader->content_type
            ]
        );
    }
}
