<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanciasMesController;
use App\Http\Controllers\GastosMesController;
use App\Http\Controllers\InsertFaturamentoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//View
Route::view('/novo-faturamento', 'novo-faturamento');
Route::view('/user', 'users.user');


//Get
Route::get('/', [FinanciasMesController::class, 'index']);
Route::get('/faturamento/{id}', [FinanciasMesController::class, 'get']);
Route::get('post/gastoMes', [GastosMesController::class, 'store']);


//Post
Route::post('post/faturamento', [FinanciasMesController::class, 'store']);

//Delete
Route::get('/deletar-faturamento/{id}', [FinanciasMesController::class, 'delete']);
Route::get('/deletar-gastoMes/{idGasto}/{idFinancias}', [GastosMesController::class, 'delete']);


//Update(PATCH)
Route::get('/atualizar-faturamento/{id}', [FinanciasMesController::class, 'redirectUpdate']);
Route::get('/update/faturamento/{id}', [FinanciasMesController::class, 'update']);




//Relatórios e Consultas
Route::get('relatorio/mes/{mes}/{ano}', [FinanciasMesController::class, 'pdfGenerator']);