<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('misters',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('file')->nullable();
            $table->enum('rol',['entrenador','segundo_entrenador','delegado','secretario'])->nullable();
            $table->integer('team_id')->nullable()->unsigned();
            $table->integer('club_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('misters');
    }
}
