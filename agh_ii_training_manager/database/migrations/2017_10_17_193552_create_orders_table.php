<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('status_code');
            $table->decimal('total_price', 8, 2);
            $table->string('order_details',255)->nullable();
            $table->string("first_name", 30);
            $table->string("second_name", 30)->nullable();
            $table->string("surname", 40);
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("country");
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("zip_code");
            $table->string("nip")->nullable();
            $table->text('additional_information')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('status_code')->references('id')->on('ref_order_status_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table){
            $table->dropForeign(['status_code']);
        });
        Schema::dropIfExists('orders');
    }
}
