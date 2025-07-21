@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Variação</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $variacao->nome }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $variacao->descricao }}</p>
            <p class="card-text"><strong>Preço:</strong> {{ $nome_produto }}</p>
            <p class="card-text"><strong>Quantidade:</strong> {{ $variacao->qtd_estoque }}</p>
            <a href="{{ route('variacoes.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('variacoes.edit', $variacao->id) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection