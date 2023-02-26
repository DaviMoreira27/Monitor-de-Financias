<?php

namespace App\Http\Controllers;

use App\Mail\pdfSender;
use App\Models\FinanciasMes;
use App\Models\GastosMes;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class FinanciasMesController extends Controller
{

    private $toAddress = 'davimsantana2706@gmail.com';

    public function index()
    {
        $financias = FinanciasMes::all()->sortBy([
            ['year', 'desc'],
            ['month', 'desc'],
        ])->where('idUser', session()->get('user.0.id'));

        $datas = $financias;
        return view('index')->with('datas', $datas);
    }

    public function pdfGenerator($mes, $year)
    {
        $financias = FinanciasMes::all()->where('month', $mes)->where('year', $year)
            ->where('idUser', session()->get('user.0.id'))->all();
        $pp['financias'] = reset($financias)->attributesToArray();
        $monthPP = $pp['financias']['year'] . '-' . $pp['financias']['month'];

        Pdf::setOption('defaultFont', 'sans-serif');

        $dom = Pdf::loadView('pdf.relatorio-mensal', $pp);
        return $dom->stream("Relatório-Mensal - $monthPP.pdf");
        
    }

    public function get($id)
    {
        $financias = FinanciasMes::all()->where('idFinancias', $id)->take(1)->all();
        $gastos = GastosMes::all()->where('idFinancias', $id)->all();
        $tipoGasto = DB::table('tipo_gasto')->get();
        return view('faturamento.get-faturamento')->with('financias', $financias)->with('gastos', $gastos)->with('tipoGasto', $tipoGasto);
    }

    public function getMonth()
    {
        $financias = FinanciasMes::all()->sortBy([
            ['month', 'desc'],
        ])->where('idUser', session()->get('user.0.id'));

        $datas = $financias;
        return view('index')->with('datas', $datas);
    }

    public function getYear()
    {
        $financias = FinanciasMes::all()->sortBy([
            ['year', 'desc'],
        ])->where('idUser', session()->get('user.0.id'));

        $datas = $financias;
        return view('index')->with('datas', $datas);
    }

    public function sendEmail(Request $request){
        $users = $request->input('email');
        $idFinancias = $request->input('idFinancias');
        $order = FinanciasMes::all()->where('idFinancias', $idFinancias)->firstOrFail();

        Mail::alwaysFrom($users);
        Mail::to($this->toAddress)->send(new pdfSender($order));

        //TODO: Exibir mensagem de sucesso
        return redirect('/')->withErrors('sucess', 'Email enviado com sucesso!');
    }

    public function redirectUpdate($id)
    {
        $financias = FinanciasMes::all()->where('idFinancias', $id)->take(1)->all();
        return view('faturamento.atualizar-faturamento')->with('financias', $financias);
    }

    public function update(Request $request, $id)
    {
        $financiaObj = (new FinanciasMes())->all()->where('idFinancias', $id);
        $gastoObj = new GastosMesController();

        $collections = json_decode($request->input('collectionGastos'), true);

        //0 => Mês, 1 => Ano
        $monthYear = $this->retrieveMonthYear($request->input('month-year'));
        if (!empty($request->input('FaturaD')) && !empty($request->input('FaturaD'))) {
            $cardValue = $this->calcCard([$request->input('FaturaD'), $request->input('FaturaC')]);
        } else {
            $cardValue = $request->input('oldFatura');
        }

        if (!empty($collections)) {
            for ($i = 0; $i < count($collections); $i++) {
                $gastoObj->store($collections[$i], $id);
            }
        }

        $newGasto = number_format($gastoObj->refactorFaturamento($id), 2, '.', '');
        foreach ($financiaObj as $financia) {
            $financia->month = $monthYear[0];
            $financia->year = $monthYear[1];
            $financia->faturaCartao = number_format($request->input('FaturaC'), 2, '.', '');
            $financia->faturaDinheiro = number_format($request->input('FaturaD'), 2, '.', '');
            $financia->gastosMes = $newGasto;
            $financia->faturamentoMes = $cardValue;
            $financia->bFinal = $cardValue - $newGasto;
            $financia->update();
        }

        return redirect('/');
    }

    public function delete($id)
    {
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

    public function store(Request $request)
    {
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

        $financia->idUser = $request->session()->get('user.0.id');
        $financia->month = $monthYear[0];
        $financia->year = $monthYear[1];
        $financia->faturaCartao = number_format($request->input('FaturaC'), 2, '.', '');
        $financia->faturaDinheiro = number_format($request->input('FaturaD'), 2, '.', '');
        $financia->gastosMes = $expenses;
        $financia->faturamentoMes = $cardValue;
        $financia->bFinal = $finalBalance;

        try {
            $financia->save();
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        $lastId = FinanciasMes::all()->last()->attributesToArray()['idFinancias'];
        $collections = json_decode($request->input('collectionGastos'), true);

        for ($i = 0; $i < count($collections); $i++) {
            (new GastosMesController())->store($collections[$i], $lastId);
        }

        return redirect('/');
    }

    private function calcCard($requestValue)
    {
        $money = $requestValue[0];
        $creditCard = $requestValue[1];

        return number_format($money + $creditCard, 2, '.', '');
    }

    private function finalBalance($requestValue, $cardValue)
    {
        $jsons = json_decode($requestValue, true);
        $arrayGastos = [];

        foreach ($jsons as $json) {
            array_push($arrayGastos, $json['valorGasto']);
        }

        $expensesValue = number_format(array_sum($arrayGastos), 2, '.', '');
        return $cardValue - $expensesValue;
    }

    private function expensesMonth($requestValue)
    {
        $jsons = json_decode($requestValue, true);
        $arrayGastos = [];

        foreach ($jsons as $json) {
            array_push($arrayGastos, $json['valorGasto']);
        }

        $expensesValue = number_format(array_sum($arrayGastos), 2, '.', '');
        return $expensesValue;
    }

    private function retrieveMonthYear($requestValue)
    {
        $getYear = str_replace('', '', strstr($requestValue, '-', true));
        $getMonth = str_replace('-', '', strstr($requestValue, '-'));

        return [$getMonth, $getYear];
    }
}
