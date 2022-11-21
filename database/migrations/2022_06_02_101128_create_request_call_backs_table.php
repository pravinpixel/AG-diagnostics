<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCallBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_call_backs', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("mobile")->nullable();
            $table->string("email")->nullable();
            $table->longText("remarks")->nullable();
            $table->string("test")->nullable();
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
        Schema::dropIfExists('request_call_backs');
    }
}
