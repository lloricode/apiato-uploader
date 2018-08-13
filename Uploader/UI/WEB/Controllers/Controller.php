<?php

namespace App\Containers\Uploader\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\UI\API\Requests\DownloadUploaderByIdRequest;

class Controller extends WebController
{
    /**
     * @param DownloadUploaderByIdRequest $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse\StreamedResponse
     */
    public function findDownloadUploaderById(DownloadUploaderByIdRequest $request)
    {
        $responseDonload = Apiato::call('Uploader@DownloadUploaderByIdAction', [$request]);

        return $responseDonload;
    }
}
