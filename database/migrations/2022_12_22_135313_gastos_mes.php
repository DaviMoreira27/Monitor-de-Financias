<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_mes', function(Blueprint $table){

            $table->id('idGasto')->autoIncrement()->from(1000);
            $table->foreignId('idFinancias');
            $table->foreignId('idTipoGasto');
            $table->decimal('valorGasto', 10, 2)->unsigned()->default(0.00);
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
        Schema::dropIfExists('gastos_mes');
    }
};
