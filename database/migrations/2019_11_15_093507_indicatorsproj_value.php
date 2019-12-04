<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndicatorsprojValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('indicatorsproj_value', function (Blueprint $table) {
        
      
        $table->integer('projects_id');
        $table->integer('indicatorsproj_id');
        $table->string('value');
        $table->string('target');
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
        Schema::dropIfExists('indicatorsproj_value');
    }
}
