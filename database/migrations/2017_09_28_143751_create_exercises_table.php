<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exercises',function(Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('description');
           $table->string('image');
           $table->integer('mister_id')->unsigned();

           $table->foreign('mister_id')->references('id')->on('misters');
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
        Schema::dropIfExists('exercises');
    }
}
