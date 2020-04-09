<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociatTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('taches', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('tache');
        $table->timestamps();
       });
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program');
            $table->timestamps();
        });
        Schema::create('perimetres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('perimetre');
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
        Schema::dropIfExists('associat_taches');
    }
}
