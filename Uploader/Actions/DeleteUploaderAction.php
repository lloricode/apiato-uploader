<?php

namespace App\Containers\Uploader\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\Exceptions\NotAllowedToDeleteFile;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteUploaderAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        throw_if(! $uploader->uploaderable->uploaderRules()->enableDeleteFile, NotAllowedToDeleteFile::class);

        return Apiato::call('Uploader@DeleteUploaderTask', [$request->id]);
    }
}
