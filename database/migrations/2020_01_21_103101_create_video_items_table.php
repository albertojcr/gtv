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
            $table->bigIncrements('id');

            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->on('videos')->references('id')->onDelete('cascade');
            $table->index(["video_id"], 'fk_video_item_video1_idx');

            $table->string('url', 245)->nullable();

            $table->string('quality', 45)->nullable();

            $table->string('format', 45)->nullable();

            $table->string('orientation')->nullable();

            $table->string('language', 10)->nullable();

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
