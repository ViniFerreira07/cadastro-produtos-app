@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estoque de Produtos</h1>
    <a href="{{ route('estoque.create') }}" class="btn btn-primary mb-3">Adicionar Produto</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($estoques as $estoque)
                <tr>
                    <td>{{ $estoque->id }}</td>
                    <td>{{ $estoque->nome_produto }}</td>
                    <td>{{ $estoque->quantidade }}</td>
                    <td>R$ {{ number_format($estoque->preco, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('estoque.edit', $estoque->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('estoque.destroy', $estoque->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum produto encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection