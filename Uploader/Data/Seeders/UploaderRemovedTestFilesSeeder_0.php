<?php

namespace App\Containers\Uploader\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Containers\Uploader\Models\Uploader;
use Illuminate\Support\Facades\Storage;

class UploaderRemovedTestFilesSeeder_0 extends Seeder
{
    public function run()
    {
        $folder = Uploader::PATH_FOLDER;

        Storage::disk('local')->deleteDirectory($folder);
        Storage::disk('public')->deleteDirectory($folder);
    }
}
