<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('reservas',function(Blueprint $table){
           $table->increments('id');
           $table->string('uso');
           $table->dateTime('fecha');
           $table->integer('tiempo');
           $table->integer('team_id')->unsigned()->nullable();
           $table->integer('instalacion_id')->unsigned();

           $table->foreign('team_id')->references('id')->on('teams');
           $table->foreign('instalacion_id')->references('id')->on('instalaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reservas');
    }
}
