<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIndicatorprocValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicatorsproc_value', function (Blueprint $table) {
           
            
            $table->integer('processes_id');
            $table->integer('indicator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
   { Schema::table('indicatorsproc_value', function (Blueprint $table) {
          
    $table->dropForeign('indicatorsproc_value_process_id_foreign');
            $table->dropForeign('indicatorsproc_value_indic_id_foreign');
            $table->dropColumn('process_id');
            $table->dropColumn('indic_id');
});
    }
}
