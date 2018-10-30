<?php

namespace App\Containers\Uploader\Tasks;

use App\Containers\Uploader\Models\Uploader;
use App\Ship\Parents\Tasks\Task;

class DownloadTask extends Task
{
    public function run(Uploader $uploader, $type = 'api')
    {
        return redirect()->route("lloricode.{$type}.uploader.download", $uploader);
    }
}
