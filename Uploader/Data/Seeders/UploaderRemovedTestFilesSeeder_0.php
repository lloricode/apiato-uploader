<?php

namespace App\Containers\Uploader\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Containers\Uploader\Models\Uploader;
use Illuminate\Support\Facades\Storage;

class UploaderRemovedTestFilesSeeder_0 extends Seeder
{
    public function run()
    {
        $config = config('filesystems');
        $folder = Uploader::PATH_FOLDER . '/' . config('uploader-container.folder_path');
        foreach (array_keys($config['disks']) as $driver) {
            if ($config['cloud'] == $driver) {
                continue;
            }

            Storage::disk($driver)->deleteDirectory($folder);
        }
    }
}
