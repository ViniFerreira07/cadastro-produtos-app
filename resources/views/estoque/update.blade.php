@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Atualizar Produto</h1>
    <form action="{{ route('estoque.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" required>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required>{{ old('descricao', $produto->descricao) }}</textarea>
        </div>
        <div>
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}" min="0" required>
        </div>
        <div>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" value="{{ old('preco', $produto->preco) }}" step="0.01" min="0" required>
        </div>
        <button type="submit">Atualizar</button>
        <a href="{{ route('estoque.index') }}">Cancelar</a>
    </form>
</div>
@endsection