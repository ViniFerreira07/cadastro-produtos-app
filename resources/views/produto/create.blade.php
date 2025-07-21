@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h2 class="mb-4">Cadastrar <span class="span-texto-criar">Produto<span></h2>
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreva o produto..." rows="3"></textarea>
        </div>
        <div class="mb-3">
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="Preço" required>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" id="qtd_estoque" name="qtd_estoque" placeholder="Estoque" required>
        </div>
        <button type="submit" class="btn btn-salvar">Salvar</button>
    </form>
</div>
@endsection