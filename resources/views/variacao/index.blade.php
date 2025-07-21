@extends('layouts.app')

@section('content')
<div class="container p-5 table-responsive">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-3 me-5 mb-3">Variações</h2>
        <div>
            <a href="{{ route('variacoes.create') }}" class="btn btn-create"><i class="bi bi-plus-circle-fill me-2"></i>Criar</a>
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
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Produto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($variacoes as $variacao)
                <tr>
                    <td>{{ $variacao->id }}</td>
                    <td>{{ $variacao->nome }}</td>
                    <td>{{ $variacao->descricao }}</td>
                    <td>{{ $variacao->qtd_estoque }}</td>
                    <td>{{ App\Models\Produto::find($variacao->produto_id)->nome }}</td>
                
                    <td>
                        <a href="{{ route('variacoes.show', $variacao->id) }}" class="btn btn-info btn-sm px-3">Ver</a>
                        <a href="{{ route('variacoes.edit', $variacao->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('variacoes.destroy', $variacao->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma variação encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $variacoes->links() }}
</div>
@endsection