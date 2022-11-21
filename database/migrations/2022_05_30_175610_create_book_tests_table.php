<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tests', function (Blueprint $table) {
            $table->id();
            $table->string("full_name")->nullable();
            $table->string("mobile")->nullable();
            $table->string("email")->nullable();
            $table->string("area")->nullable();
            $table->string("test")->nullable();
            $table->string("visit")->nullable();
            $table->string("date")->nullable();
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
        Schema::dropIfExists('book_tests');
    }
}
