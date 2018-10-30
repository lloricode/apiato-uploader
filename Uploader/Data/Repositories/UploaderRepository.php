<?php

namespace App\Containers\Uploader\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class UploaderRepository
 */
class UploaderRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
