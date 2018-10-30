<?php

namespace App\Containers\Uploader\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class DownloadUploaderByIdTransporter extends Transporter
{
    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            // enter all properties here

            // allow for undefined properties
            // 'additionalProperties' => true,
            'id' => [
                'type' => 'integer',
            ],
        ],
        'required' => [// define the properties that MUST be set
        ],
        'default' => [// provide default values for specific properties here
        ],
    ];
}
