<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThematicAreaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thematic_area_user', function (Blueprint $table) {
            $table->foreignId('thematic_area_id')->references('id')->on('thematic_areas')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date');
            $table->primary(['thematic_area_id', 'user_id', 'date']);
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thematic_area_user');
    }
};
