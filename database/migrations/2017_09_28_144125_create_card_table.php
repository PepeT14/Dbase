<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cards',function(Blueprint $table){
           $table->increments('id');
           $table->enum('color',['yellow','red']);
           $table->integer('minute');
           $table->integer('player_match_id')->unsigned();

           $table->foreign('player_match_id')->references('id')->on('player_match');
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
        Schema::dropIfExists('cards');
    }
}
