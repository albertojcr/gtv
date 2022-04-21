<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login', 100);
            $table->string('name', 200);
            $table->string('surnames', 200);
            $table->string('email', 100)->nullable();
            $table->string('profile', 100)->nullable();
            $table->string('password', 500)->nullable();
            $table->unsignedBigInteger('thematic_area_id')->nullable();
            $table->foreign('thematic_area_id')->on('thematic_areas')->references('id')->onDelete('cascade');
            $table->index(["thematic_area_id"], 'fk_user_area_thematic1_idx');
            $table->date('last_login')->nullable();
            $table->boolean('active')->default(true);
            $table->string('remember_token', 100)->nullable();;
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
        Schema::dropIfExists('users');
    }
}
