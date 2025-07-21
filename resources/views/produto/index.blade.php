@extends('layouts.app')

@section('content')
<div class="container p-5 table-responsive">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-3 mb-3 me-5">Lista de <span class="span-texto-criar">Produtos</span></h2>
        <div>
            <a href="{{ route('produtos.create') }}" class="btn btn-create"><i class="bi bi-plus-circle-fill me-2"></i>Criar</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('erro_quantidade'))
        <div class="alert alert-danger">{{ session('erro_quantidade') }}</div>
    @endif

    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>
                        {{App\Models\Estoque::where('produto_id', $produto->id)->first()->quantidade}}
                    </td>
                    <td>
                        <div class="d-flex">
                            <div class="me-2">
                                <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info btn-sm px-3">Ver</a>
                            </div>
                            <div class="me-2">
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            </div>
                            <div class="me-2">
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                                </form>
                            </div>
                            <div>
                                <button 
                                    class="btn btn-success btn-sm px-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalQuantidade"
                                    data-produto-id="{{ $produto->id }}"
                                    data-produto-nome="{{ $produto->nome }}">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>
                            </div>
                        <div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum produto cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalQuantidade" tabindex="-1" aria-labelledby="modalQuantidadeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formAdicionarCarrinho" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalQuantidadeLabel">Adicionar ao Carrinho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade para <span id="produtoNome"></span>:</label>
                    <input type="number" min="1" class="form-control" id="quantidade" name="quantidade" value="1" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </form>
  </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById('modalQuantidade');
        var form = document.getElementById('formAdicionarCarrinho');
        var produtoNomeSpan = document.getElementById('produtoNome');
        var quantidadeInput = document.getElementById('quantidade');

        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var produtoId = button.getAttribute('data-produto-id');
            var produtoNome = button.getAttribute('data-produto-nome');
            produtoNomeSpan.textContent = produtoNome;
            quantidadeInput.value = 1;
            form.action = '/carrinho/adicionar/' + produtoId;
        });
    });
    </script>
@endsection

@yield('scripts')
@endsection