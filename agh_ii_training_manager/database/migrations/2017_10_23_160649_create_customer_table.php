<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("first_name", 30);
            $table->string("second_name", 30)->nullable();
            $table->string("surname", 40);
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("country");
            $table->string("email");
            $table->string("phone");
            $table->string("zip-code");
            $table->string("password");
            $table->rememberToken();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
           $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('customers');
    }
}
