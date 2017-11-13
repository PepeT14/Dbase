<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('player_stats',function(Blueprint $table){
           $table->increments('id');
           $table->string('season');
           $table->integer('yellow_cards');
           $table->integer('red_cards');
           $table->integer('goals');
           $table->string('team');
           $table->integer('player_id')->unsigned();

           $table->foreign('player_id')->references('id')->on('players');
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
        Schema::dropIfExists('player_stats');
    }
}
