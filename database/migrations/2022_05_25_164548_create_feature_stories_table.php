<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_stories', function (Blueprint $table) {
            $table->id();
            $table->string("story_title")->nullable();
            $table->string("date")->nullable();
            $table->string("story_url")->nullable();
            $table->string("description")->nullable();
            $table->string("pdf")->nullable();
            $table->string("video_link")->nullable();
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
        Schema::dropIfExists('feature_stories');
    }
}
