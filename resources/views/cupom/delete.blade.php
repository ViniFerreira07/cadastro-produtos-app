<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cupom</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Excluir Cupom</h1>
        <p>Tem certeza que deseja excluir este cupom?</p>
        <form action="{{ route('cupom.destroy', $cupom->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir</button>
            <a href="{{ route('cupom.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>