<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_packages', function (Blueprint $table) {
            $table->id();
            $table->integer("primaryId")->nullable();
            $table->string("packageName")->nullable();
            $table->string("packageCode")->nullable();
            $table->string("icon")->nullable();
            $table->string("cityId")->nullable();
            $table->string("cityName")->nullable();
            $table->longText("testLists")->nullable();
            $table->string("testSchedule")->nullable();
            $table->longText("sampleType")->nullable();
            $table->string("ageRestrictions")->nullable();
            $table->string("preRequisties")->nullable();
            $table->string("reportAvailability")->nullable();
            $table->longText("comments")->nullable();
            $table->string("fees")->nullable();
            $table->string("homeVisit")->comment("Yes/No")->nullable();
            $table->string("discountFees")->nullable();
            $table->integer("is_selected")->default(0);
            $table->string("meta_title")->nullable();
            $table->longText("meta_description")->nullable();
            $table->string("meta_keyword")->nullable();
            $table->integer("sorting_order")->nullable()->unique();
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
        Schema::dropIfExists('manage_packages');
    }
}
