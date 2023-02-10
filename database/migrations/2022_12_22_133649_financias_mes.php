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
        Schema::create('financias_mes', function(Blueprint $table){
            $table->id('idFinancias')->autoIncrement()->from(1000);
            $table->string('month', 2);
            $table->string('year', 4);
            $table->decimal('gastosMes', 19, 3)->unsigned()->default(0.00);
            $table->decimal('faturamentoMes', 19, 3)->unsigned()->default(0.00);
            $table->decimal('bFinal', 19, 3)->default(0.00);
            $table->timestamps($precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financias_mes');
    }
};