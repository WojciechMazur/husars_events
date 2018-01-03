<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceHeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_heats', function (Blueprint $table) {
            $table->increments('id');
            $table->time('heat_start');
            $table->enum('type', ['open', 'elite', 'competitive', 'kids'])->default('open');
            $table->decimal('price');
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('signed_in')->default(0);
            $table->unsignedInteger('race_id');
        });

        Schema::table('race_heats', function (Blueprint $table){
            $table->foreign('race_id')->references('id')->on('races')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_heats');
    }
}
