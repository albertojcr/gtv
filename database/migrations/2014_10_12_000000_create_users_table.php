<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->default('Juan');
            $table->string('email', 45)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 500); // TODO cambiar nombre a password_hash
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('deleted_at')->nullable();


            $table->string('login', 45);
            $table->string('salt', 45); // TODO generar salt al crear usuarios
            $table->string('profile', 45);

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
        Schema::dropIfExists('users');
    }
};
