<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VariacaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pedidos', PedidoController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('estoque', EstoqueController::class);
Route::resource('cupons', CupomController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('variacoes', VariacaoController::class);

Route::post('/carrinho/adicionar/{produto}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::delete('/carrinho/remover/{produto}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::get('/carrinho/atualizar/{produto}', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar');
Route::get('/carrinho/limpar', [CarrinhoController::class, 'limpar'])->name('carrinho.limpar');
Route::get('/carrinho/finalizar', [CarrinhoController::class, 'finalizar'])->name('carrinho.finalizar');
Route::post('/carrinho/calcular-frete', [CarrinhoController::class, 'calcularFrete'])->name('carrinho.calcularFrete');
Route::post('/carrinho/verificar-cep', [CarrinhoController::class, 'verificarCep'])->name('carrinho.verificarCep');
Route::post('/carrinho/aplicar-cupom', [CarrinhoController::class, 'aplicarCupom'])->name('carrinho.aplicarCupom');
Route::get('/carrinho/remover-cupom', [CarrinhoController::class, 'removerCupom'])->name('carrinho.removerCupom');

Route::post('/cliente/store-carrinho', [ClienteController::class, 'storeCarrinho'])->name('cliente.storeCarrinho');
Route::post('/cliente-cadastrado', [ClienteController::class, 'setClienteCadastrado'])->name('cliente.cliente-cadastrado');

Route::middleware('api')
    ->prefix('api')
    ->group(function () {
        Route::get('/atualizar-pedido/{id}/{status}', [PedidoController::class, 'atualizarPedido']);
    });