<?php

namespace App\Containers\Uploader\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteUploaderAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Uploader@DeleteUploaderTask', [$request->id]);
    }
}
