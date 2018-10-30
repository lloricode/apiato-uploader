<?php

namespace App\Containers\Uploader\Contract;

use App\Containers\Uploader\Classes\UploaderOptions;

interface UploaderContract
{
    public function uploaderRules(): UploaderOptions;
}
