<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team_materials',function(Blueprint $table){
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('stock');
            $table->string('type');
            $table->string('subtype');
            $table->text('description');
            $table->integer('team_id')->unsigned();

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('team_materials');
    }
}
