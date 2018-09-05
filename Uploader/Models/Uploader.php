<?php

namespace App\Containers\Uploader\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Support\Facades\Storage;
use Lloricode\LaravelUploader\Models\Uploader as BaseUploader;

class Uploader extends BaseUploader
{
    use HashIdTrait;
    use HasResourceKeyTrait;
    
    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'uploaders';
}
