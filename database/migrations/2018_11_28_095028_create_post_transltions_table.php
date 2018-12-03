<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTransltionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 500)->nullable();
	        $table->string('slug', 1000)->nullable();
            $table->string('description', 1000)->nullable();
            $table->text('content')->nullable();
	        $table->string('meta_description', 1000)->nullable();
	        $table->string('meta_keyword', 500)->nullable();
	        $table->string('meta_title', 500)->nullable();
            $table->integer('post_id');
	        $table->string('locale')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
