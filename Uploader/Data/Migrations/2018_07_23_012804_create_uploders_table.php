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

            $table->morphs('uploaderable');
            $table->integer('user_id')->unsigned();
            $table->string('type');
            $table->string('extension');
            $table->string('path')->collation = 'utf8_unicode_ci';
            $table->unsignedInteger('bytes')->comment('Size in Bytes');
            $table->unsignedTinyInteger('is_storage')->default(true);

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
