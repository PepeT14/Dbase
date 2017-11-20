<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notes',function(Blueprint $table){
           $table->increments('id');
           $table->string('title');
           $table->text('note');
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
        Schema::dropIfExists('notes');
    }
}
