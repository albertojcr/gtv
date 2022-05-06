<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotographiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photographies', function (Blueprint $table) {
            $table->id();
            $table->string('route', 245)->nullable();
            $table->foreignId('point_of_interest_id')->nullable()->references('id')->on('point_of_interests')->onDelete('cascade');
            $table->integer('order')->nullable();
            $table->timestamp('date_create')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->foreignId('creator')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('updater')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('thematic_area_id')->nullable()->references('id')->on('thematic_areas');

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
        Schema::dropIfExists('photographies');
    }
}
