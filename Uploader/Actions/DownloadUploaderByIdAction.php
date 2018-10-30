<?php

namespace App\Containers\Uploader\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\Data\Transporters\DownloadUploaderByIdTransporter;
use App\Ship\Parents\Actions\Action;

class DownloadUploaderByIdAction extends Action
{
    public function run(DownloadUploaderByIdTransporter $request, $type = 'api')
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        return Apiato::call('Uploader@DownloadTask', [$uploader, $request->type]);
    }
}
