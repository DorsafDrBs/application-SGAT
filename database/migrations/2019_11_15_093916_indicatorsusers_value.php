<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndicatorsusersValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('indicatorsusers_value', function (Blueprint $table) {
        $table->integer('users_id');
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
        Schema::dropIfExists('indicatorsusers_value');
    }
}
