@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Cupom</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Código: {{ $cupom->codigo }}</h5>
            <p class="card-text"><strong>Desconto:</strong> {{ $cupom->desconto }}%</p>
            <p class="card-text"><strong>Validade:</strong> {{ $cupom->validade }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $cupom->status ? 'Ativo' : 'Inativo' }}</p>
        </div>
    </div>

    <a href="{{ route('cupons.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    <a href="{{ route('cupons.edit', $cupom->id) }}" class="btn btn-primary mt-3">Editar</a>
</div>
@endsection