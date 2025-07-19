<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Cupom</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Atualizar Cupom</h2>
        <form action="{{ route('cupom.update', $cupom->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', $cupom->codigo) }}" required>
            </div>
            <div class="mb-3">
                <label for="desconto" class="form-label">Desconto (%)</label>
                <input type="number" class="form-control" id="desconto" name="desconto" value="{{ old('desconto', $cupom->desconto) }}" min="0" max="100" required>
            </div>
            <div class="mb-3">
                <label for="validade" class="form-label">Validade</label>
                <input type="date" class="form-control" id="validade" name="validade" value="{{ old('validade', $cupom->validade) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('cupom.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>