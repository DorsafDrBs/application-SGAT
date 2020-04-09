<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorsprocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicatorsprocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('detail');
            $table->string('target');
            $table->string('orange');
            $table->string('periodicity');
            $table->string('datasource');
            $table->string('operator_cp');
            $table->string('min');
            $table->string('max');  
            $table->unsignedBigInteger('process_id')->nullable();
            $table->foreign('process_id')->references('id')->on('processes');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('unit');
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
        Schema::dropIfExists('indicatorsprocs');
    }
}
