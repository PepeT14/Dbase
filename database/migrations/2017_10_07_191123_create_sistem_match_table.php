<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sistem_match',function(Blueprint $table){
            $table->integer('sistem_id')->unsigned();
            $table->integer('match_id')->unsigned();

            $table->foreign('sistem_id')->references('id')->on('sistems');
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
        Schema::dropIfExists('sistem_match');
    }
}
