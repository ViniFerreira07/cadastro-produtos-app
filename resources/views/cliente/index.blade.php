@extends('layouts.app')

@section('content')
<div class="container p-5 table-responsive">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-3 mb-3 me-5">Clientes</h2>
        <div>
            <a href="{{ route('clientes.create') }}" class="btn btn-create"><i class="bi bi-plus-circle-fill me-2"></i>Criar</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{$cliente->email}}</td>
                    <td>{{$cliente->cidade}}</td>
                    <td>{{$cliente->estado}}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm px-3">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhum pedido encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $clientes->links() }}
</div>
@endsection