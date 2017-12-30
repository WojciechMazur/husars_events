<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageAggregationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_image', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('image_id');
            $table->unsignedInteger('product_id');

            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('product_image', function (Blueprint $table){
        $table->dropForeign(['image_id']);
        $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('product_image');
    }
}
