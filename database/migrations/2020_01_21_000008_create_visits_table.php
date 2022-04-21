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
            $table->bigIncrements('id');
            $table->dateTime('hour')->nullable();
            $table->string('deviceid',85);
            $table->string('url', 85)->nullable();
            $table->string('appversion',45)->nullable();
            $table->string('useragent',95)->nullable();
            $table->string('ssoo',45)->nullable();
            $table->string('ssooversion',45)->nullable();
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->unsignedBigInteger('point_of_interest_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('point_of_interest_id','fk_visit_point_of_interest1_idx');

            $table->foreign('point_of_interest_id','fk_visit_point_of_interest1_idx')->on('point_of_interests')->references('id')->onDelete('cascade');
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
