<?php

namespace App\Containers\Uploader\UI\API\Controllers;

use App\Containers\Uploader\UI\API\Requests\DeleteUploaderRequest;
use App\Containers\Uploader\UI\API\Requests\FindDownloadUploaderByIdRequest;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Uploader\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param FindDownloadUploaderByIdRequest $request
     * @return array
     */
    public function findDownloadUploaderById(FindDownloadUploaderByIdRequest $request)
    {
        $responseDonload = Apiato::call('Uploader@FindDownloadUploaderByIdAction', [$request]);

        return $responseDonload;
    }


    /**
     * @param DeleteUploaderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUploader(DeleteUploaderRequest $request)
    {
        Apiato::transactionalCall('Uploader@DeleteUploaderAction', [$request]);

        return $this->noContent();
    }
}
