<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tutor_events',function(Blueprint $table){
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('place');
            $table->string('title');
            $table->string('category');
            $table->integer('tutor_id')->unsigned();

            $table->foreign('tutor_id')->references('id')->on('tutors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tutor_events');
    }
}
