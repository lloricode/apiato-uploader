<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Uploader\Data\Transporters\DownloadUploaderByIdTransporter;
use Apiato\Core\Foundation\Facades\Apiato;

class DownloadUploaderByIdAction extends Action
{
    public function run(DownloadUploaderByIdTransporter $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        return Apiato::call('Uploader@DownloadTask', [$uploader]);
    }
}
