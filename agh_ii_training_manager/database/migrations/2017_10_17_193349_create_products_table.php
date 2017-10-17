<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_type_code')->unsigned();
            $table->string('product_name');
            $table->decimal('product_price', 6, 2);
            $table->text('description')->nullable();
        });

        Schema::table('products', function (Blueprint $table){
            $table->foreign('product_type_code')
                ->references('product_type_code')->on('ref_product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
