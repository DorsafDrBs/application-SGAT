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
        Schema::table('programs', function (Blueprint $table) {
            $table->unsignedBigInteger('taches_id')->nullable();
            $table->foreign('taches_id')->references('id')->on('taches');
        });
        Schema::table('perimetres', function (Blueprint $table) {
          
            $table->unsignedBigInteger('programs_id')->nullable();
            $table->foreign('programs_id')->references('id')->on('programs');
      
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
