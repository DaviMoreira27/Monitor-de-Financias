CREATE VIEW view_gastoFinancias AS 
SELECT 
    `financias_mes`.`idFinancias` as `idFinanciasF`,
    `financias_mes`.`month` as `month`, 
    `financias_mes`.`year` as `year`, 
    `financias_mes`.`gastoMes` as `gastoMes`, 
    `financias_mes`.`faturaDinheiro` as `faturaDinheiro`, 
    `financias_mes`.`faturaCartao` as `faturaCartao`, 
    `financias_mes`.`faturamentoMes` as `faturamentoMes`, 
    `financias_mes`.`bFinal` as `bFinal`, 

    `gastos_mes`.`idGasto` as `idGasto`,
    `gastos_mes`.`idFinancias` as `idFinanciasG`, 
    `gastos_mes`.`idTipoGasto` as `idTipoGastoG`, 
    `gastos_mes`.`valorGasto` as `valorGasto`, 
    `gastos_mes`.`created_at` as `created_at`, 

    `tipo_gasto`.`idTipoGasto` as `idTipoGasto`, 
    `tipo_gasto`.`nomeGasto` as `nomeGasto`, 
    `tipo_gasto`.`tipoGasto` as `tipoGasto`, 
    `tipo_gasto`.`created_at` as `created_at`
FROM 
    `financias_mes`
    INNER JOIN `gastos_mes` ON `financias_mes`.`idFinancias` = `gastos_mes`.`idFinancias`
    INNER JOIN `tipo_gasto` ON `gastos_mes`.`idTipoGasto` = `tipo_gasto`.`idTipoGasto`;
