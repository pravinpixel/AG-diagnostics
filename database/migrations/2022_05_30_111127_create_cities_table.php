<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("country_id")->nullable();
            $table->unsignedBigInteger("state_id")->nullable();
            $table->unsignedBigInteger("stateId")->nullable();
            $table->string("state");
            $table->integer("cityId");
            $table->string("city");
            $table->text("city_code")->nullable();
            $table->string("call_us")->nullable();
            $table->string("bcc_email")->nullable();
            $table->string("meta_title")->nullable();
            $table->string("meta_keyword")->nullable();
            $table->string("meta_description")->nullable();
            $table->foreign("country_id")->references('id')->on('countries')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign("state_id")->references('id')->on('states')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('cities');
    }
}
