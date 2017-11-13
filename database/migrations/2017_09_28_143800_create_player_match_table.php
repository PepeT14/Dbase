<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('player_match',function(Blueprint $table){
            $table->increments('id');
            $table->integer('minutes');
            $table->boolean('summoned');
            $table->boolean('playing');
            $table->integer('player_id')->unsigned();
            $table->integer('match_id')->unsigned();

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('match_id')->references('id')->on('matchs');
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
        Schema::dropIfExists('player_match');
    }
}
