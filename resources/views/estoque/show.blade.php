@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Produto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $produto->nome }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $produto->descricao }}</p>
            <p class="card-text"><strong>Quantidade em Estoque:</strong> {{ $produto->quantidade }}</p>
            <p class="card-text"><strong>Preço:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
        </div>
    </div>

    <a href="{{ route('estoque.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection