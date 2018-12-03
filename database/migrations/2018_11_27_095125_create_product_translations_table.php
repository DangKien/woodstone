<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug', 500)->nullable();
            $table->string('description', 1500)->nullable();
            $table->text('content')->nullable();
            $table->string('digital_radio')->nullable();
            $table->text('specifications')->nullable();
	        $table->text('series')->nullable();
	        $table->string('meta_title')->nullable();
	        $table->string('meta_description', 500)->nullable();
	        $table->string('meta_keyword')->nullable();
	        $table->integer('product_id');
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
        Schema::dropIfExists('product_translations');
    }
}
