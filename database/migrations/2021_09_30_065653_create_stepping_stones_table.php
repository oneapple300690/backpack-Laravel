<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSteppingStonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stepping_stones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description')->default('');
            $table->text('description');
            $table->string('video_link')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('audio_file')->nullable();
            $table->text('main_content');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stepping_stones');
    }
}
