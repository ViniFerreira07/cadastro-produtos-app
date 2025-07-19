@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Pedido</h1>

    <div class="card mb-3">
        <div class="card-header">
            Pedido #{{ $pedido->id }}
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $pedido->cliente->nome ?? 'N/A' }}</p>
            <p><strong>Data do Pedido:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Status:</strong> {{ $pedido->status }}</p>
        </div>
    </div>

    <h4>Produtos</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->pivot->quantidade }}</td>
                <td>R$ {{ number_format($produto->pivot->preco, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($produto->pivot->quantidade * $produto->pivot->preco, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <strong>Total do Pedido: R$ {{ number_format($pedido->total, 2, ',', '.') }}</strong>
    </div>

    <a href="{{ route('pedido.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection