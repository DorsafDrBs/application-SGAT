<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processes', function (Blueprint $table)
         {
         
            $table->unsignedBigInteger('familles_id')->nullable()->unsigned();
            $table->foreign('familles_id')
                  ->references('id')
                  ->on('familles')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {Schema::table('processes', function (Blueprint $table)
        {
    $table->dropForeign(['familles_id']);
});
    }
}
