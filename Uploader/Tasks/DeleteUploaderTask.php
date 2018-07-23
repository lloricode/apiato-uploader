<?php

namespace App\Containers\Uploader\Tasks;

use App\Containers\Uploader\Data\Repositories\UploaderRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteUploaderTask extends Task
{
    protected $repository;

    public function __construct(UploaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
