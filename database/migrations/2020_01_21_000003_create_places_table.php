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
            $table->id();
            $table->string('name', 45);
            $table->string('description', 45)->nullable();
            $table->foreignId('place_id')->nullable()->references('id')->on('places')->onDelete('cascade');
            $table->timestamp('date_create')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->foreignId('creator')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('updater')->references('id')->on('users')->onDelete('cascade');

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
