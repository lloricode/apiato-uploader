<?php

namespace App\Containers\Uploader\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use File;
use App\Containers\Uploader\Models\Uploader;

class UploaderRemovedTestFilesSeeder_0 extends Seeder
{
    public function run()
    {
        $folder = Uploader::PATH_FOLDER;
        File::deleteDirectory(storage_path("app/$folder/"), true);
        File::deleteDirectory(public_path("assets/$folder/"), true);
    }
}
