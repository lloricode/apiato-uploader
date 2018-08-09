<?php 

namespace App\Containers\Uploader\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Containers\Uploader\Models\Uploader as Model;

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

    public function uploaderDelete()
    {
        $this->delete();
    }
}
