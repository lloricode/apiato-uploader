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

        $label = $uploader->label?:$uploader->uploaderable->uploaderRules()->fileNamePrefix;

        return response()->download(
            $wholePath,
            $label . now()->format('Ymd_Hi') . '.' . $uploader->extension,
            [
                'Content-Type: ' . $uploader->content_type
            ]
        );
    }
}
