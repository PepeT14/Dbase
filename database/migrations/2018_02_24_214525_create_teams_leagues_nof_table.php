<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsLeaguesNofTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('teams_leagues_nof',function(Blueprint $table){
           $table->integer('team_id')->unsigned();
           $table->integer('league_nof_id')->unsigned();

           $table->foreign('team_id')->references('id')->on('teams');
           $table->foreign('league_nof_id')->references('id')->on('leagues_nof');
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
        Schema::dropIfExists('teams_leagues_nof');
    }
}
