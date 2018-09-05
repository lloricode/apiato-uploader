<?php

namespace App\Containers\Uploader\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Storage;
use App\Containers\Uploader\Models\Uploader;

class DownloadTask extends Task
{
    public function run(Uploader $uploader, $type = 'api')
    {
        return redirect()->route("lloricode.{$type}.uploader.download", $uploader);
    }
}
