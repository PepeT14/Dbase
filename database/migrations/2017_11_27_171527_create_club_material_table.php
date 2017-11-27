<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('club_materials',function(Blueprint $table){
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('stock');
            $table->string('name');
            $table->text('description');
            $table->integer('club_id')->unsigned();

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
        Schema::dropIfExists('club_materials');
    }
}
