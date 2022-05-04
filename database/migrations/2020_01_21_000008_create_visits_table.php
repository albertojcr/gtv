<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->dateTime('hour')->nullable();
            $table->string('deviceid',85);
            $table->string('appversion',45)->nullable();
            $table->string('useragent',95)->nullable();
            $table->string('ssoo',45)->nullable();
            $table->string('ssooversion',45)->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->foreignId('point_of_interest_id')->nullable()->references('id')->on('point_of_interests')->onDelete('cascade');

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
        Schema::dropIfExists('visits');

    }
}
