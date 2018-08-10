<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Uploader\Models\Uploader;
use Illuminate\Support\Facades\Storage;

class FindDownloadUploaderByIdAction extends Action
{
    public function run(Request $request)
    {
        $uploader = Apiato::call('Uploader@FindUploaderByIdTask', [$request->id]);

        $uploderable = $uploader->uploaderable;
        $uploderableRules = $uploderable->uploaderRules();

        $label = $uploader->label?:$uploderableRules->fileNamePrefix;

        return Storage::disk($uploader->storage_driver)->download(
            $uploader->path,
            $label . now()->format('Ymd_Hi') . '.' . $uploader->extension,
            [
                'Content-Type: ' . $uploader->content_type
            ]
        );
    }
}
