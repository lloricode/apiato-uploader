<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Storage;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\Exceptions\NotAllowedToDeleteFile;

class DeleteUploaderAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);


        throw_if(!$uploader->uploaderable->uploaderRules()->enableDeleteFile, NotAllowedToDeleteFile::class);

        return Apiato::call('Uploader@DeleteUploaderTask', [$request->id]);
    }
}
