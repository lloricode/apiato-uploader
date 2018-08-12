<?php

namespace App\Containers\Uploader\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class NotAllowedToDeleteFile extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_BAD_REQUEST;

    public $message = 'Not allowed to delete file independently.';
}
