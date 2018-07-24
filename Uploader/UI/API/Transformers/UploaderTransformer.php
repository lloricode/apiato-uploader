<?php

namespace App\Containers\Uploader\UI\API\Transformers;

use App\Containers\Uploader\Models\Uploader;
use App\Ship\Parents\Transformers\Transformer;

class UploaderTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Uploader $entity
     *
     * @return array
     */
    public function transform(Uploader $entity)
    {
        $link = config('apiato.api.url');
        $response = [
            'object' => 'Uploader',
            'id' => $entity->getHashedKey(),
            'label' => $entity->label,
            'download_link' => route('api_uploader_download', $entity->getHashedKey()),
            'extension' => $entity->extension,
            'content_type' => $entity->content_type,
            'readable_size' => formatBytesUnits($entity->bytes),

            'created_at' => (string) $entity->created_at,
            'readable_created_at'  => $entity->created_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
        ], $response);

        return $response;
    }
}
