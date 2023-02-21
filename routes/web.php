<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanciasMesController;
use App\Http\Controllers\GastosMesController;
use App\Http\Controllers\InsertFaturamentoController;
use App\Http\Controllers\UserController;
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
Route::view('/pag/novo/faturamento', 'faturamento.novo-faturamento')->name('new/pag/faturamento');
Route::view('/pag/register', 'users.register')->name('pag/register/login');
Route::view('/user/forgot-password', 'users.forgot-password')
->middleware('guest')->name('password.request');

//Get
Route::get('/', [FinanciasMesController::class, 'index'])->name('home');
Route::get('/faturamento/{id}', [FinanciasMesController::class, 'get']);

//Post
Route::post('post/faturamento', [FinanciasMesController::class, 'store'])->name('new/faturamento');

//Delete
Route::get('/deletar/faturamento/{id}', [FinanciasMesController::class, 'delete']);
Route::get('/deletar/gastoMes/{idGasto}/{idFinancias}', [GastosMesController::class, 'delete']);


//Update(PATCH)
Route::get('/atualizar/faturamento/{id}', [FinanciasMesController::class, 'redirectUpdate']);
Route::get('/update/faturamento/{id}', [FinanciasMesController::class, 'update']);

//Relatórios e Consultas
Route::get('relatorio/mes/{mes}/{ano}', [FinanciasMesController::class, 'pdfGenerator']);


// Login e Registro

Route::post('/user/register', [UserController::class, 'register'])->name('register');
Route::post('/user/login', [UserController::class, 'login'])->name('login');
Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/reset/password', [UserController::class, 'resetPass'])
->middleware('guest')->name('reset-pass');

Route::get('/reset-password/{token}', function (string $token) {
    return view('users.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [UserController::class, 'newPassword'])->middleware('guest')->name('password.update');


Route::get('/session/test', function(){
    return session()->all();
});
