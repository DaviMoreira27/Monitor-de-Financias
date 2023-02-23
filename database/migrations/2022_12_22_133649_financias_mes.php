<?php

use App\Models\User;
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
            $table->foreignIdFor(User::class, 'idUser');
            $table->string('month', 2);
            $table->string('year', 4);
            $table->decimal('gastosMes', 10, 2)->unsigned()->default(0.00);
            $table->decimal('faturaDinheiro', 10, 2)->unsigned()->default(0.00);
            $table->decimal('faturaCartao', 10, 2)->unsigned()->default(0.00);
            $table->decimal('faturamentoMes', 10, 2)->unsigned()->default(0.00);
            $table->decimal('bFinal', 10, 2)->default(0.00);
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
