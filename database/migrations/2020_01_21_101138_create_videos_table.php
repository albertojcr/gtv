<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 245);

            $table->string('url', 245)->nullable();
            $table->string('route', 245)->nullable();

            $table->unsignedBigInteger('point_of_interest_id')->nullable();
            $table->foreign('point_of_interest_id')->on('point_of_interests')->references('id')->onDelete('cascade');
            $table->index(["point_of_interest_id"], 'fk_video_points_of_inderest1_idx');

            $table->integer('order')->nullable();

            $table->boolean('published')->default(0);

            $table->timestamp('date_create')->nullable();

            $table->timestamp('last_update')->nullable();

            $table->unsignedBigInteger('creator')->nullable();
            $table->foreign('creator')->on('users')->references('id')->onDelete('cascade');
            $table->index(["creator"], 'fk_video_user1_idx');

            $table->unsignedBigInteger('updater')->nullable();
            $table->foreign('updater')->on('users')->references('id')->onDelete('cascade');
            $table->index(["updater"], 'fk_video_user2_idx');

            $table->unsignedBigInteger('thematic_area_id')->nullable();
            $table->foreign('thematic_area_id')->on('thematic_areas')->references('id');
            $table->index(["thematic_area_id"], 'fk_video_thematic_area1_idx');

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
        Schema::dropIfExists('videos');
    }
}
