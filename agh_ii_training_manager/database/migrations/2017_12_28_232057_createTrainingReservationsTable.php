<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('training_id');
            $table->timestamps();
        });

        Schema::table('training_reservations', function (Blueprint $table){
            $table->foreign('training_id')->references('id')->on('trainings');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_reservations', function (Blueprint $table){
            $table->dropForeign('training_id');
            $table->dropForeign('customer_id');
        });
        Schema::dropIfExists('training_reservations');
    }
}
