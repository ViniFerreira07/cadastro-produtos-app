@extends('layouts.app')

@section('content')
<div class="container p-5 table-responsive">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-3 mb-3">Registro de <span class="span-texto-criar">Estoque<span></h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do produto</th>
                <th>Quantidade</th>
                <th>Data de Registro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($estoques as $estoque)
                <tr>
                    <td>{{ $estoque->id }}</td>
                    <td>{{ $estoque->nome_produto }}</td>
                    <td>{{ $estoque->quantidade }}</td>
                    <td>{{ $estoque->created_at}}</td>
                    <td>
                        <a href="{{ route('estoque.show', $estoque->id) }}" class="btn btn-sm btn-info px-3">Ver</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum produto encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $estoques->links() }}
</div>

@endsection