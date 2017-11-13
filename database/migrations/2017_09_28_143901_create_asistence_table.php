<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asistences',function(Blueprint $table){
           $table->increments('id');
           $table->integer('player_id')->unsigned();
           $table->integer('training_id')->unsigned();
           $table->boolean('asiste');
           $table->text('description');

           $table->foreign('player_id')->references('id')->on('players');
           $table->foreign('training_id')->references('id')->on('trainings');
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
        Schema::dropIfExists('asistences');
    }
}
