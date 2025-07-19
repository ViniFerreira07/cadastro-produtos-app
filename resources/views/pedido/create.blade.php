<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criar Pedido</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Criar Novo Pedido</h1>
        <form action="{{ route('pedido.store') }}" method="POST">
            @csrf
            <div>
                <label for="cliente">Cliente:</label>
                <input type="text" id="cliente" name="cliente" required>
            </div>
            <div>
                <label for="produto">Produto:</label>
                <input type="text" id="produto" name="produto" required>
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" min="1" required>
            </div>
            <div>
                <label for="data_pedido">Data do Pedido:</label>
                <input type="date" id="data_pedido" name="data_pedido" required>
            </div>
            <button type="submit">Salvar Pedido</button>
        </form>
    </div>
</body>
</html>