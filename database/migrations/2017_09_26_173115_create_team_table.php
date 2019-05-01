<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('teams',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->integer('league_id')->unsigned()->nullable();
            $table->integer('club_id')->unsigned();

            $table->foreign('league_id')->references('id')->on('leagues');
            $table->foreign('club_id')->references('id')->on('clubs');
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
        Schema::dropIfExists('teams');
    }
}
