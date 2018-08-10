<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DownloadUploaderByIdAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        return Apiato::call('Uploader@DownloadTask', [$uploader]);
    }
}
