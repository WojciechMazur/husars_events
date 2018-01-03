<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('race_heat_id');
            $table->time('time')->nullable();
            $table->enum('status', ['DNS', 'DNF', 'DSQ'])->nullable();
        });

        Schema::table('race_results', function (Blueprint $table){
           $table->foreign('race_heat_id')->references('id')->on('race_heats')->onDelete('cascade');
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
        Schema::dropIfExists('race_results');
    }
}
