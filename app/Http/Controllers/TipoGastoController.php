<?php

namespace App\Http\Controllers;

use App\Models\TipoGasto;
use Illuminate\Http\Request;

class TipoGastoController extends Controller
{
    

    public function listTiposGastos(){
        $getTiposGastos = TipoGasto::all()->toArray();
        return view('gasto.novo-tipo-gasto', [
            'getTiposGastos' => $getTiposGastos ? $getTiposGastos : []]);
    }

    public function store(Request $request){
         $request->validate([
            'nomeGasto' => 'required',
            'tipoGasto' => 'required'
         ]);


         $tipoGasto = new TipoGasto([
            'nomeGasto' => $request->nomeGasto,
            'tipoGasto' => $request->tipoGasto,
         ]);
         if($tipoGasto->save()){
            $getTiposGastos = TipoGasto::all()->toArray();
            return view('gasto.novo-tipo-gasto', ['getTiposGastos' => $getTiposGastos ? $getTiposGastos : []])->with('sucess', "Tipo adicionado com sucesso!");
         }else{
            $getTiposGastos = TipoGasto::all()->toArray();
            return view('gasto.novo-tipo-gasto', ['getTiposGastos' => $getTiposGastos ? $getTiposGastos : []])->with('error', "Ocorreu um erro ao adicionar o tipo!");
         }
    }

    public function delete($idTipoGasto){
        $getTiposGastosDelete = TipoGasto::where('idTipoGasto', $idTipoGasto)->delete();
        $getTiposGastos = TipoGasto::all()->toArray();
        if($getTiposGastosDelete){
            return view('gasto.novo-tipo-gasto', ['getTiposGastos' => $getTiposGastos ? $getTiposGastos : []])->with('sucess', "Tipo deletado com sucesso!");
        }else{
            return view('gasto.novo-tipo-gasto', ['getTiposGastos' => $getTiposGastos ? $getTiposGastos : []])->with('error', "Ocorreu um erro ao deletar o tipo!");
        }

    }
}
