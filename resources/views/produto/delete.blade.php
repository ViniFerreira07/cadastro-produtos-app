@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Excluir Produto</h2>
    <div class="alert alert-warning">
        Tem certeza que deseja excluir o produto <strong>{{ $produto->nome }}</strong>?
    </div>
    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
</div>
@endsection