<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisterEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mister_events',function(Blueprint $table){
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('place');
            $table->string('title');
            $table->string('category');
            $table->integer('mister_id')->unsigned();

            $table->foreign('mister_id')->references('id')->on('misters');
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
        Schema::dropIfExists('mister_events');
    }
}
