<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->string('quality', 45)->nullable();
            $table->string('format', 45)->nullable();
            $table->string('orientation', 45)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_items');
    }
}
