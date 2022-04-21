<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qr',45)->nullable();
            $table->string('url',45)->nullable();

            $table->integer('distance')->nullable();
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();

            $table->unsignedBigInteger('place_id')->nullable();
            $table->dateTime('creation_date');
            $table->datetime('last_update_date')->nullable();
            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('updater')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index("updater", 'fk_points_of_interest_user2_idx');
            $table->index("place_id", 'fk_points_of_interest_place_idx');
            $table->index("creator", 'fk_points_of_interest_user1_idx');

            $table->foreign('place_id','fk_points_of_interest_place_idx')->on('places')->references('id')->onDelete('cascade');
            $table->foreign('creator','fk_points_of_interest_user1_idx')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('updater','fk_points_of_interest_user2_idx')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_of_interests');
    }
}
