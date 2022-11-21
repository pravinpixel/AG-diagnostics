<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleCollectionCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_collection_centers', function (Blueprint $table) {
            $table->id();
            $table->integer("centerId");
            $table->integer("localityId")->nullable();
            $table->string("location")->nullable();
            $table->string("timing");
            $table->longText("address");
            $table->integer("cityId");
            $table->string("city");
            $table->integer("stateId");
            $table->string("state");
            $table->string("phone");
            $table->string("email");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("googleReviewLink");
            $table->string("whatsAppLink");
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
        Schema::dropIfExists('sample_collection_centers');
    }
}
