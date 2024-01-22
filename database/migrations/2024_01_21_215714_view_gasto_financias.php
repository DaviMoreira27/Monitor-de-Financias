<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_gastoFinancias AS 
        SELECT 
            `financias_mes`.`idFinancias` AS `idFinanciasF`,
            `financias_mes`.`month` AS `month`, 
            `financias_mes`.`year` AS `year`, 
            `financias_mes`.`gastosMes` AS `gastosMes`, 
            `financias_mes`.`faturaDinheiro` AS `faturaDinheiro`, 
            `financias_mes`.`faturaCartao` AS `faturaCartao`, 
            `financias_mes`.`faturamentoMes` AS `faturamentoMes`, 
            `financias_mes`.`bFinal` AS `bFinal`,
            `financias_mes`.`created_at` AS `created_at`, 
        
            `gastos_mes`.`idGasto` AS `idGasto`,
            `gastos_mes`.`idFinancias` AS `idFinanciasG`, 
            `gastos_mes`.`idTipoGasto` AS `idTipoGastoG`, 
            `gastos_mes`.`valorGasto` AS `valorGasto`, 
        
            `tipo_gasto`.`idTipoGasto` AS `idTipoGasto`,
            `tipo_gasto`.`nomeGasto` AS `nomeGasto`, 
            `tipo_gasto`.`tipoGasto` AS `tipoGasto`
        FROM 
            `financias_mes`
            LEFT JOIN `gastos_mes` ON `financias_mes`.`idFinancias` = `gastos_mes`.`idFinancias`
            LEFT JOIN `tipo_gasto` ON `gastos_mes`.`idTipoGasto` = `tipo_gasto`.`idTipoGasto`;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_gastoFinancias");
    }
};
