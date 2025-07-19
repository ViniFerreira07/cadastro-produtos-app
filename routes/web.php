<?php

use App\Http\Controllers\CupomController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pedidos', PedidoController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('estoque', EstoqueController::class);
Route::resource('cupom', CupomController::class);