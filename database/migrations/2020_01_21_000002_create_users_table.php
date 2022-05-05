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
            $table->id();
            $table->string('login', 45);
            $table->string('password', 500)->nullable(); // TODO cambiar nombre a password_hash
            $table->string('salt', 45)->nullable(); // TODO generar salt al crear usuarios
            $table->string('email', 45)->nullable();
            $table->string('profile', 45)->nullable();

/*            $table->string('name', 200);
            $table->string('surnames', 200);
            $table->foreignId('thematic_area_id')->nullable()->references('id')->on('thematic_areas')->references('id')->onDelete('cascade');
            $table->date('last_login')->nullable();
            $table->boolean('active')->default(true);
            $table->string('remember_token', 100)->nullable();*/

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
