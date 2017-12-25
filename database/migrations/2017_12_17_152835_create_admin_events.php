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
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('place');
            $table->string('title');
            $table->string('category');
            $table->integer('admin_id')->unsigned();

            $table->foreign('admin_id')->references('id')->on('admin_clubs');
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
