@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do <span class="span-texto-criar">Estoque<span></h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $estoque->nome_produto }}</h5>
            <p class="card-text"><strong>Quantidade em Estoque:</strong> {{ $estoque->quantidade }}</p>
        </div>
    </div>

    <a href="{{ route('estoque.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection