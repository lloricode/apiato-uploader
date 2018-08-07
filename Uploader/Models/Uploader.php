<?php

namespace App\Containers\Uploader\Models;

use App\Ship\Parents\Models\Model;

class Uploader extends Model
{
    const UPDATED_AT = null;
    const PATH_FOLDER = 'uploaders';

    protected $fillable = [
        'uploaderable_id',
        'uploaderable_type',
        'user_id',
        'extension',
        'content_type',
        'path',
        'bytes',
        'is_storage',
        'label',
        'client_original_name',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'id',
        'uploaderable_id',
        'uploaderable_type',
        'user_id',
        'is_storage',
        'path',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'uploaders';
}
