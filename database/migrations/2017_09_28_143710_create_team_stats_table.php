<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team_stats',function(Blueprint $table){
           $table->increments('id');
           $table->string('season');
           $table->integer('win_matchs');
           $table->integer('lose_matchs');
           $table->integer('positivaGoals');
           $table->integer('points');
           $table->string('league');
           $table->integer('team_id')->unsigned();

           $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('team_stats');
    }
}
