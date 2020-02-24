<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetTacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
       Schema::create('taches', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('tache');
         $table->timestamps();
        });
        Schema::create('projet_tache', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tache_id')->nullable();
            $table->foreign('tache_id')->references('id')->on('taches');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });
        Schema::table('indicatorsproj_value', function (Blueprint $table) {
          
            $table->unsignedBigInteger('tache_id')->nullable();
            $table->foreign('tache_id')->references('id')->on('taches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_tache');
    }
}
