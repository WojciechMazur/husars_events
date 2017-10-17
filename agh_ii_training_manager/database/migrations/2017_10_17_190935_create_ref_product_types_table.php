<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_product_types', function (Blueprint $table) {
            $table->increments('product_type_code');
            $table->integer('parent_product_type_code')->unsigned();
            $table->string('product_type_description', 50);
        });

        Schema::table('ref_product_types', function (Blueprint $table){
            $table->foreign('parent_product_type_code')->references('product_type_code')->on('ref_product_types')->nullable()->after('product_type_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_product_types');
    }
}
