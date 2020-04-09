<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssociatUsersIndics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associat_users_indics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('indic_id')->nullable();
            $table->foreign('indic_id')->references('id')->on('indicatorsprojs');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('project_has_users');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->String('target');
            $table->string('orange');
            $table->string('operator_cp');
            $table->timestamps();
        });
       Schema::table('indicatorsusers_value', function (Blueprint $table) {
       
            $table->unsignedBigInteger('associat_users_indic_id')->nullable();
            $table->foreign('associat_users_indic_id')->references('id')->on('associat_users_indics');
            
    
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
