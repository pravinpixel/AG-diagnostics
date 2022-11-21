<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeVisitAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_visit_areas', function (Blueprint $table) {
            $table->id();
            $table->integer("areaId");
            $table->string("area");
            $table->integer("cityId");
            $table->string("city");
            $table->integer("stateId");
            $table->string("state")->nullable();
            $table->integer("status")->default(1);
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
        Schema::dropIfExists('home_visit_areas');
    }
}
