<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEventCategorie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('admin_event_categories',function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('color');
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
        Schema::dropIfExists('admin_event_categories');
    }
}
