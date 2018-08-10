<?php

namespace App\Containers\Uploader\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\UI\API\Requests\FindDownloadUploaderByIdRequest;

class Controller extends WebController
{
    /**
     * @param FindDownloadUploaderByIdRequest $request
     * @return array
     */
    public function findDownloadUploaderById(FindDownloadUploaderByIdRequest $request)
    {
        $responseDonload = Apiato::call('Uploader@DownloadUploaderByIdAction', [$request]);

        return $responseDonload;
    }
}
