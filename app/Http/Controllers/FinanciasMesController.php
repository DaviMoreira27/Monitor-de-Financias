<?php

namespace App\Http\Controllers;

use App\Models\FinanciasMes;
use App\Models\GastosMes;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class FinanciasMesController extends Controller
{
    public function index(){
        $financias = FinanciasMes::all()->sortBy('month')->unique($key = 'month')->values();
        $datas = $financias;
        return view('index')->with('datas', $datas);
    }

    public function get($id)
    {
        $financias = FinanciasMes::all()->where('idFinancias', $id)->take(1)->all();
        $gastos = GastosMes::all()->where('idFinancias', $id)->all();
        $tipoGasto = DB::table('tipo_gasto')->get();
        return view('get-faturamento')->with('financias', $financias)->with('gastos', $gastos)->with('tipoGasto', $tipoGasto);
    }


    public function delete($id){
        $deleteAll = (new GastosMesController)->deleteAll($id);
        $gastos = FinanciasMes::where('idFinancias', $id)->delete();
        return redirect('/');
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function store(Request $request){
        $financia = new FinanciasMes();


        $validation = $request->validate([
            'month-year' => ['required', 'date_format:Y-m'],
            'FaturaD' => ['required', 'numeric'],
            'FaturaC' => ['required', 'numeric'],
            'collectionGastos' => ['required', 'json']
        ]);

        //0 => Mês, 1 => Ano
        $monthYear = $this->retrieveMonthYear($request->input('month-year'));
        $cardValue = $this->calcCard([$request->input('FaturaD'), $request->input('FaturaC')]);
        $finalBalance = $this->finalBalance($request->input('collectionGastos'), $cardValue);
        $expenses = $this->expensesMonth($request->input('collectionGastos'));

        $financia->month = $monthYear[0];
        $financia->year = $monthYear[1];
        $financia->gastosMes = $expenses;
        $financia->faturamentoMes = $cardValue;
        $financia->bFinal = $finalBalance;

        try{
            $financia->save();
        }catch(ModelNotFoundException $e){
            return back()->withError($e->getMessage())->withInput();
        }
        $lastId = FinanciasMes::all()->last()->attributesToArray()['idFinancias'];
        $collections = json_decode($request->input('collectionGastos'), true);
        
        for($i = 0; $i < count($collections); $i++){
            (new GastosMesController())->store($collections[$i], $lastId);
        }

        return redirect('/');
    }

    private function calcCard($requestValue){
        $money = $requestValue[0];
        $creditCard = $requestValue[1];                 

        return number_format($money + $creditCard, 0, '.', '.');
    }

    private function finalBalance($requestValue, $cardValue){
        $jsons = json_decode($requestValue, true);
        $arrayGastos = [];

        foreach($jsons as $json){
            array_push($arrayGastos, $json['valorGasto']);
        }

        $expensesValue = (float) number_format(array_sum($arrayGastos), 0, '.', '.');
        return $cardValue - $expensesValue;
    }

    private function expensesMonth($requestValue)
    {
        $jsons = json_decode($requestValue, true);
        $arrayGastos = [];

        foreach ($jsons as $json) {
            array_push($arrayGastos, $json['valorGasto']);
        }

        $expensesValue = (float) number_format(array_sum($arrayGastos), 0, '.', '.');
        return $expensesValue;
    }

    private function retrieveMonthYear($requestValue){
        $getYear = strstr($requestValue, '-', true);
        $getMonth = str_replace('-', '', strstr($requestValue, '-'));

        return [$getMonth, $getYear];
    }

}
