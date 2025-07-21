@extends('layouts.app')

@section('content')
@if(session('cupom'))
    <div class="alert alert-info">
        Cupom <strong>{{ session('cupom')['codigo'] ?? ''}}</strong> aplicado! Desconto de <strong>{{ session('cupom')['desconto'] ?? ''}}%</strong>.
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container px-5 mt-3">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-1 mb-1">Carrinho de <span class="span-texto-criar">Compras</span></h2>
    </div>

    @if(isset($carrinho) && count($carrinho) > 0)
        <table class="table table-bordered table-dark table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carrinho as $item)
                    <tr>
                        <td>{{ $item['produto']->nome }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($item['produto']->preco, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item['produto']->preco * $item['quantidade'], 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('carrinho.remover', $item['produto']->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                    @php $total += $item['produto']->preco * $item['quantidade']; @endphp
                @endforeach
            </tbody>
        </table>

        <div class="section-total-carrinho p-3">
            <div class="mb-2">
                <span id="freteValor" class="ms-2">Valor do frete: R$ {{ number_format($frete, 2, ',', '.') }}</span>
            </div>

            <div class="d-flex align-items-center mb-3">
                <div>
                    <form action="{{ route('carrinho.aplicarCupom') }}" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="text" name="codigo" class="form-control w-auto" placeholder="Digite o cupom" required>

                        <input type="hidden" name="valor_total" value="{{ $total }}">

                        <button type="submit" class="btn btn-aplicar-cupom btn-sm ms-2">Aplicar Cupom</button>
                    </form>
                </div>

                <div>
                    @if(session('cupom'))
                        <a href="{{ route('carrinho.removerCupom') }}">
                            <button class="btn btn-outline-danger btn-sm ms-2">Remover Cupom</button>
                        </a>
                    @endif

                    @if(session('erro_cupom'))
                        <span class="text-danger ms-2">{{ session('erro_cupom') }}</span>
                    @endif
                </div>
            </div>

            <div>
                @if(session('cupom'))
                    <div>
                        <p>Subtotal: R$ {{ number_format($total, 2, ',', '.') }}</p>
                        <p>Desconto ({{ session('cupom')['desconto'] ?? '' }}%): -R$ {{ number_format(session('cupom')['totalComDesconto'] ?? 0, 2, ',', '.') }}</p>
                    </div>
                @endif
            </div>

            <h4>
                <span class="span-texto-criar">Total:</span>
                R$ {{ number_format(session('cupom')['totalComDesconto'] ?? $total, 2, ',', '.') }}
            </h4>

            <div class="d-flex">
                <a href="{{ route('carrinho.finalizar') }}" class="btn btn-success btn-finalizar-compra mt-2 me-2">Finalizar Compra</a>
                <a href="{{ route('produtos.index') }}" class="btn btn-salvar mt-2">Continuar Comprando</a>
            </div>
        </div>
    @else
        <p class="mt-3">Seu carrinho está vazio.</p>

        <a href="{{ route('produtos.index') }}" class="btn btn-salvar mt-4">Continuar Comprando</a>
    @endif
</div>

@endsection
