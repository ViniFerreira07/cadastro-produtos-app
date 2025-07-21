@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h2 class="mb-4">Editar <span class="span-texto-criar">Variação<span></h2>
    <form id="form_variacao" action="{{ route('variacoes.update', $variacao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <input type="text" class="form-control" id="nome" name="nome" value="{{$variacao->nome}}" placeholder="Nome">
        </div>
        
        <div class="mb-3">
            <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreva a variação..." row="3">{{$variacao->descricao}}</textarea>
        </div>

        <div class="mb-3">
            <select class="form-select" id="produto_id_variacao" name="produto_id" required>
                <option value="">Selecione um Produto</option>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}" data-estoque="{{ $produto->qtd_estoque }}">{{ $produto->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="selecionar_qtd_estoque mb-3">
            <input class="form-control" type="text" id="qtd_estoque_variacao" name="qtd_estoque" value="{{$variacao->qtd_estoque}}" placeholder="Quantidade em Estoque" pattern="\d*" inputmode="numeric">
            
             @error('qtd_estoque')
                <div class="text-danger w-100 m-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-salvar px-4 mt-3">Salvar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form_variacao');
            const input = document.getElementById('qtd_estoque_variacao');
            const produtoSelect = document.getElementById('produto_id_variacao');

            produtoSelect.addEventListener('change', function () {
                const estoqueSection = document.querySelector('.selecionar_qtd_estoque');
                if (this.value) {
                    estoqueSection.classList.remove("d-none");
                    const selectedOption = this.options[this.selectedIndex];
                    estoqueMaximo = parseInt(selectedOption.getAttribute('data-estoque'));
                } else {
                    estoqueSection.classList.add("d-none");
                }
            });

            form.addEventListener('submit', function (e) {
                const valor = parseInt(input.value || 0);
                if (valor > valSelectProduto) {
                    e.preventDefault();
                    alert(`Quantidade não pode ser maior do que a existente no estoque: ${valSelectProduto}`);
                    input.focus();
                }
            });
        });
    </script>
@endsection