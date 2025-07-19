<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excluir Pedido</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Excluir Pedido</h1>
        <p>Tem certeza que deseja excluir o pedido <strong>#{{ $pedido->id }}</strong>?</p>
        <form action="{{ route('pedido.destroy', $pedido->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir</button>
            <a href="{{ route('pedido.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>