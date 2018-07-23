<?php

namespace App\Containers\Uploader\Tasks;

use App\Containers\Uploader\Data\Repositories\UploaderRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUploaderByIdTask extends Task
{
    protected $repository;

    public function __construct(UploaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
