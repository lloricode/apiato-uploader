<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Filesystem\Filesystem;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteUploaderAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        // delete file
        $wholePath = $uploader->is_storage ? storage_path() : public_path();
        $wholePath .= $uploader->path;

        (new Filesystem)->delete($wholePath);

        // delete releted model
        $uploader->uploaderable->uploaderDelete();

        return Apiato::call('Uploader@DeleteUploaderTask', [$request->id]);
    }
}
