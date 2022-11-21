<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_labs', function (Blueprint $table) {
            $table->id();
            $table->string("lab_name")->nullable();
            $table->string("address")->nullable();
            $table->integer("country_id")->nullable();
            $table->integer("state_id")->nullable();
            $table->integer("city_id")->nullable();
            $table->integer("area_id")->nullable();
            $table->string("location_map_url")->nullable();
            $table->string("location_map")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("near_by")->nullable();
            $table->string("timing")->nullable();
            $table->string("timing_day")->nullable();
            $table->string("landline")->nullable();
            $table->string("mobile")->nullable();
            $table->string("toll_free_number")->nullable();
            $table->string("contact_person")->nullable();
            $table->string("email")->nullable();
            $table->longText("facilities")->nullable();
            $table->string("specialty")->nullable();
            $table->string("department")->nullable();
            $table->string("meta_title")->nullable();
            $table->string("meta_keyword")->nullable();
            $table->string("meta_description")->nullable();
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('manage_labs');
    }
}
