<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_events', function (Blueprint $table) {
            $table->id();
            $table->string("event_name")->nullable();
            $table->string("type")->nullable();
            $table->string("start")->nullable();
            $table->string("description")->nullable();
            $table->string("choose")->nullable();
            $table->string("news_image")->nullable();
            $table->string("photo")->nullable();
            $table->string("mobile_image")->nullable();
            $table->string("video_url")->nullable();
            $table->string("news_url")->nullable();
            $table->string("event_image")->nullable();
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
        Schema::dropIfExists('news_events');
    }
}
