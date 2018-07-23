<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\Models\Uploader;

class FindDownloadUploaderByIdAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        $wholePath = $uploader->is_storage ? storage_path() : public_path();
        $wholePath .= $uploader->path;

        return response()->download(
            $wholePath,
            'test.' . $uploader->extension,
            [
                'Content-Type: ' . $uploader->type
            ]
        );
    }
}
