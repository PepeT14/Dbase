<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstalacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('instalaciones',function(Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('tipo');
           $table->string('terreno');
           $table->integer('sectores')->default(1);
           $table->integer('club_id')->unsigned();
           $table->timestamps();

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
        Schema::dropIfExists('instalaciones');
    }
}
