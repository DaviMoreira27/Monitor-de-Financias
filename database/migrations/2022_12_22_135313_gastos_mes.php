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
            $table->string('nomeGasto')->charset('UTF8');
            $table->timestamp('dataGasto');
            $table->decimal('valorGasto', 19, 3)->unsigned()->default(0.00);
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
