<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_has_taches', function (Blueprint $table)
         {
         
            $table->unsignedBigInteger('projects_id')->nullable();
            $table->foreign('projects_id')->references('id')->on('projects');
            $table->unsignedBigInteger('perimetre_id')->nullable();
            $table->foreign('perimetre_id')->references('id')->on('perimetres');
          
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
    }
}
