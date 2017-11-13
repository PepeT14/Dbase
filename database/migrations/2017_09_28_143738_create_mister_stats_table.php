<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisterStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mister_stats',function(Blueprint $table){
           $table->integer('mister_id')->unsigned();
           $table->integer('team_stats_id')->unsigned();

           $table->foreign('mister_id')->references('id')->on('misters');
           $table->foreign('team_stats_id')->references('id')->on('team_stats');
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
        Schema::dropIfExists('mister_stats');
    }
}
