<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_tests', function (Blueprint $table) {
            $table->id();
            $table->integer("primaryId");
            $table->string("testName")->nullable();
            $table->string("testCode")->nullable();
            $table->string("cityId")->nullable();
            $table->string("cityName")->nullable();
            $table->longText("details")->nullable();
            $table->string("sample")->nullable();
            $table->string("container")->nullable();
            $table->string("qty")->nullable();
            $table->string("storage")->nullable();
            $table->string("method")->nullable();
            $table->longText("comments")->nullable();
            $table->string("fees")->nullable();
            $table->string("homeVisit")->comment("Yes/No")->nullable();
            $table->string("discountFees")->nullable();

            $table->string("pre_instruction")->nullable();
            $table->string("report_delivery")->nullable();
            $table->string("description")->nullable();
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
        Schema::dropIfExists('manage_tests');
    }
}
