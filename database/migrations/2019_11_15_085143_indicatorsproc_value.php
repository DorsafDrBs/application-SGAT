<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndicatorsprocValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicatorsproc_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('value');
            $table->integer('target');
            $table->unsignedBigInteger('process_id')->nullable();
          
            $table->foreign('process_id')->references('id')->on('processes');
            $table->unsignedBigInteger('indic_id')->nullable();
          
            $table->foreign('indic_id')->references('id')->on('indicatorsprocs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicatorsproc_value');
        //
    }
}
