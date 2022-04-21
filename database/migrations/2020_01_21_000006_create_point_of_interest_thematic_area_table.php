<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointOfInterestThematicAreaTable extends Migration


{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_interest_thematic_area', function (Blueprint $table) {
            $table-> unsignedBigInteger('thematic_area_id')->nullable();
            $table->unsignedBigInteger('point_of_interest_id')->nullable();

            $table->string('title',245);
            $table->string('description',245)->nullable();
            $table->string('language',10);

            $table->index('point_of_interest_id','fk_thematic_area_has_point_of_interest_point_of_interest1_idx');
            $table->index('thematic_area_id','fk_thematic_area_id_has_point_of_interest_thematic_area1_idx');

            $table->foreign('thematic_area_id','fk_thematic_area_id_has_point_of_interest_thematic_area1_idx')
            ->on('thematic_areas')
                ->references('id')->onDelete('cascade');

            $table->foreign('point_of_interest_id','fk_thematic_area_has_point_of_interest_point_of_interest1_idx')
                ->on('point_of_interests')
                ->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_of_interest_thematic_area');
    }
}
