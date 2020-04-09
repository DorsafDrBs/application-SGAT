<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociatIndicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associat_indics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('indic_id')->nullable();
            $table->foreign('indic_id')->references('id')->on('indicatorsprojs');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('project_has_taches');
            
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->String('target');
            $table->string('orange');
            $table->string('operator_cp');
            $table->timestamps();
        });
       Schema::table('indicatorsproj_value', function (Blueprint $table) {
       
            $table->unsignedBigInteger('associat_indic_id')->nullable();
            $table->foreign('associat_indic_id')->references('id')->on('associat_indic');
            
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associat_indic');
    }
}
