@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Atualizar Pedido</h1>
        <form action="{{ route('pedido.update', $pedido->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="cliente">Cliente</label>
                <input type="text" id="cliente" name="cliente" class="form-control" value="{{ old('cliente', $pedido->cliente) }}" required>
            </div>

            <div class="form-group">
                <label for="produto">Produto</label>
                <input type="text" id="produto" name="produto" class="form-control" value="{{ old('produto', $pedido->produto) }}" required>
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" id="quantidade" name="quantidade" class="form-control" value="{{ old('quantidade', $pedido->quantidade) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Pendente" {{ old('status', $pedido->status) == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Em andamento" {{ old('status', $pedido->status) == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="Concluído" {{ old('status', $pedido->status) == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('pedido.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection