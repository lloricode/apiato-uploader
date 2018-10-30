<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateUploadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('label')->nullable();
            $table->string('client_original_name')->nullable();
            $table->morphs('uploaderable');
            $table->integer('user_id')->unsigned();
            $table->string('content_type');
            $table->string('extension');
            $table->enum('disk', array_keys(Config::get('filesystems.disks')))->default(config('filesystems.default'));
            $table->string('path')->collation = 'utf8_unicode_ci';
            $table->unsignedInteger('bytes')->comment('Size in Bytes');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploaders');
    }
}
