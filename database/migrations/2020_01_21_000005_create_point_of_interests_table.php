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
            $table->id();
            $table->string('qr',45)->nullable();
            $table->integer('distance')->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->foreignId('place_id')->nullable()->references('id')->on('places')->onDelete('cascade');
            $table->dateTime('creation_date');
            $table->datetime('last_update_date')->nullable();
            $table->foreignId('creator')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('updater')->nullable()->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('point_of_interests');
    }
}
