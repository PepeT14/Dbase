<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('players',function(Blueprint $table){
           $table->rememberToken();
           $table->increments('id');
           $table->string('name');
           $table->string('email')->unique();
           $table->string('username')->unique();
           $table->string('password');
           $table->integer('number');
           $table->string('photo');
           $table->date('birthday');
           $table->string('position');
           $table->integer('team_id')->unsigned();
           $table->timestamps();

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
        Schema::dropIfExists('players');
    }
}
