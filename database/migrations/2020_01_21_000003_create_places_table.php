<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->string('url', 45)->nullable();;
            $table->string('description', 45)->nullable();

            $table->unsignedBigInteger('place_id')->nullable();
            $table->foreign('place_id')->on('places')->references('id')->onDelete('cascade');
            $table->index(["place_id"], 'fk_place_place1_idx');

            $table->timestamp('date_create')->nullable();
            $table->timestamp('last_update')->nullable();

            $table->unsignedBigInteger('creator')->nullable();
            $table->foreign('creator')->on('users')->references('id')->onDelete('cascade');
            $table->index(["creator"], 'fk_place_user1_idx');

            $table->unsignedBigInteger('updater')->nullable();
            $table->foreign('updater')->on('users')->references('id')->onDelete('cascade');
            $table->index(["updater"], 'fk_place_user2_idx');
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
        Schema::dropIfExists('places');
    }
}
