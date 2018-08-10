<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUplodersTable extends Migration
{

    /**
     * Run the migrations.
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
            $table->enum('storage_driver', array_keys(config('filesystems.disks')))->default(config('filesystems.default'));
            $table->string('path')->collation = 'utf8_unicode_ci';
            $table->unsignedInteger('bytes')->comment('Size in Bytes');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('uploaders');
    }
}
