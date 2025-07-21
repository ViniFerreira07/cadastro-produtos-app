@extends('layouts.app')

@section('content')
<div class="container p-5 table-responsive">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-3 mb-3 me-5">Pedidos</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm px-3">Ver</a>
                        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum pedido encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $pedidos->links() }}
</div>
@endsection