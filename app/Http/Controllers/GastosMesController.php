<?php

namespace App\Http\Controllers;

use App\Models\FinanciasMes;
use Illuminate\Http\Request;
use App\Models\GastosMes;
use Faker\Core\DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class GastosMesController extends Controller
{
    //

    public function store($request, $lastId){
        $gastoModel = new GastosMes();

        //Atributos
        $gastoModel->idFinancias = $lastId;
        // $gastoModel->nomeGasto = $request['nomeGasto'];
        $gastoModel->idTipoGasto = $request['tipoGasto'];
        $gastoModel->valorGasto = $request['valorGasto'];

        return $gastoModel->save();
    }

    public function deleteAll($id)
    {
        return GastosMes::where('idFinancias', $id)->delete();
    }

    public function delete($idGastos, $idFinancias){
        $gastos = GastosMes::where('idGasto', $idGastos)->delete();
        $faturamentoMes = FinanciasMes::all()->where('idFinancias', $idFinancias);
        foreach($faturamentoMes as $financia){
            $financia->gastosMes = number_format($this->refactorFaturamento($idFinancias), 2, '.', '');
            $financia->bFinal = $financia->faturamentoMes -
            number_format($this->refactorFaturamento($idFinancias), 2, '.', '');
            $financia->update();
        }
        return redirect()->back();
    }

    public function refactorFaturamento($idFinancias){
        $gastos = GastosMes::all()->where('idFinancias', $idFinancias);
        $valorDespesa = [];
        foreach($gastos as $gasto){
            array_push($valorDespesa, $gasto->valorGasto);  
        }
        return array_sum($valorDespesa);
    }
}
