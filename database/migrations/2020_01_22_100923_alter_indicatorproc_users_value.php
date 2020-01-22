<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIndicatorprocUsersValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicatorsproc_value', function (Blueprint $table) {
            $table->Year('annee');
            $table->String('semaine');
            $table->String('mois');
            $table->String('trimestre');
        });
        Schema::table('indicatorsusers_value', function (Blueprint $table) {
            $table->Year('annee');
            $table->String('semaine');
            $table->String('mois');
            $table->String('trimestre');
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
