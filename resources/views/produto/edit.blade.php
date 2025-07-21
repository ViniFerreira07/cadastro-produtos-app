@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar <span class="span-texto-criar">Produto</span></h2>
    <ul class="nav nav-tabs" id="produtoTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="dados" aria-selected="true">
                Dados do Produto
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="estoque-tab" data-bs-toggle="tab" data-bs-target="#estoque" type="button" role="tab" aria-controls="estoque" aria-selected="false">
                Estoque
            </button>
        </li>
    </ul>
    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="tab-content mt-3" id="produtoTabContent">
            <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $produto->nome) }}" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" required>{{ old('descricao', $produto->descricao) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="{{ old('preco', $produto->preco) }}" required>
                </div>
            </div>
            <div class="tab-pane fade" id="estoque" role="tabpanel" aria-labelledby="estoque-tab">
                <div class="mb-3">
                    <label for="qtd_estoque" class="form-label">Quantidade em Estoque</label>
                    <input type="number" name="qtd_estoque" id="qtd_estoque" class="form-control" value="{{ old('qtd_estoque', App\Models\Estoque::where('produto_id', $produto->id)->first()->quantidade ?? '') }}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-salvar mt-3">Salvar Alterações</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection