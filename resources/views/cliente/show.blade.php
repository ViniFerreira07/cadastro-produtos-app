@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do <span class="span-texto-criar">Cliente</span></h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $cliente->nome }}</h5>
            <p class="card-text"><strong>Email: </strong> {{ $cliente->email }}</p>
            <p class="card-text"><strong>CEP: </strong>{{$cliente->cep}}</p>
            <p class="card-text"><strong>CEP: </strong>{{$cliente->cep}}</p>
            <p class="card-text"><strong>Número: </strong>{{$cliente->numero}}</p>
            <p class="card-text"><strong>Rua: </strong>{{$cliente->rua}}</p>
            <p class="card-text"><strong>Bairro: </strong>{{$cliente->bairro}}</p>
            <p class="card-text"><strong>Cidade: </strong>{{$cliente->cidade}}</p>
            <p class="card-text"><strong>Estado: </strong>{{$cliente->estado}}</p>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-salvar">Editar</a>
        </div>
    </div>
</div>
@endsection