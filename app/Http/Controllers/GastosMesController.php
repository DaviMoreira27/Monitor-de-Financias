<?php

namespace App\Http\Controllers;

use App\Models\FinanciasMes;
use Illuminate\Http\Request;
use App\Models\GastosMes;
use DateTime as GlobalDateTime;
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
        $gastoModel->nomeGasto = $request['nomeGasto'];
        $gastoModel->idTipoGasto = $request['tipoGasto'];
        $gastoModel->dataGasto = $request['dataGasto'];
        $gastoModel->valorGasto = $request['valorGasto'];

        return $gastoModel->save();
    }
}
