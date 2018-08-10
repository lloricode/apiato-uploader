<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Storage;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteUploaderAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        // delete file
        Storage::disk($uploader->storage_driver)
            ->delete($uploader->path);

        // delete releted model
        $uploader->uploaderable->uploaderDelete();

        return Apiato::call('Uploader@DeleteUploaderTask', [$request->id]);
    }
}
