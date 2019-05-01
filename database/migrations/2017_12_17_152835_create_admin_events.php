<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('admin_events',function(Blueprint $table){
            $table->increments('id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('place')->nullable();
            $table->string('title');
            $table->integer('admin_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();

            $table->foreign('admin_id')->references('id')->on('admin_clubs');
            $table->foreign('category_id')->references('id')->on('admin_event_categories');
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
        Schema::dropIfExists('admin_events');
    }
}
