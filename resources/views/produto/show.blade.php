@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do <span class="span-texto-criar">Produto</span></h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $produto->nome }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $produto->descricao }}</p>
            <p class="card-text"><strong>Preço:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
            <p class="card-text"><strong>Quantidade:</strong> {{ $produto->quantidade }}</p>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-salvar">Editar</a>
        </div>
    </div>
</div>
@endsection