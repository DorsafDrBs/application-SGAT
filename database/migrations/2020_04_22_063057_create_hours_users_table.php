<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Year('annee');
            $table->String('semaine');
            $table->String('mois');
            $table->String('trimestre');
            $table->integer('h_r_rl');
            $table->integer('h_r_est');
            $table->integer('h_fact');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('project_has_users');
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
        Schema::dropIfExists('hours_users');
    }
}
