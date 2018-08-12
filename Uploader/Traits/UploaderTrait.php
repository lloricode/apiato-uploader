<?php 

namespace App\Containers\Uploader\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Containers\Uploader\Models\Uploader as Model;
use Illuminate\Support\Facades\Storage;

trait UploaderTrait
{

    /**
     * Return Uploader relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function uploaders() :MorphMany
    {
        return $this->morphMany(Model::class, 'uploaderable');
    }

    public function delete()
    {
        foreach ($this->uploaders as $uploader) {
            
            // delete file
            $uploader->delete();
        }

        parent::delete();
    }
}
