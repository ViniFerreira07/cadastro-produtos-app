@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cupons</h1>
    <a href="{{ route('cupom.create') }}" class="btn btn-primary mb-3">Novo Cupom</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Desconto (%)</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cupons as $cupom)
                <tr>
                    <td>{{ $cupom->id }}</td>
                    <td>{{ $cupom->codigo }}</td>
                    <td>{{ $cupom->desconto }}</td>
                    <td>{{ $cupom->validade }}</td>
                    <td>
                        <a href="{{ route('cupom.edit', $cupom->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('cupom.destroy', $cupom->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum cupom encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $cupons->links() }}
</div>
@endsection