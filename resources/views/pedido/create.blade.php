@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h2 class="mb-4">Cadastrar <span class="span-texto-criar">Pedido<span></h2>
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="produto" name="produto" placeholder="Produto" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" placeholder="Quantidade" required>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" id="data_pedido" name="data_pedido" placeholder="Data do pedido" required>
            </div>
            <button type="submit" class="btn btn-salvar">Salvar</button>
        </form>
    </div>
@endsection