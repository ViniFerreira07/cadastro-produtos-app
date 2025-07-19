<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criar Cupom</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Criar Novo Cupom</h2>
    <form action="{{ route('cupom.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código do Cupom</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="mb-3">
            <label for="desconto" class="form-label">Desconto (%)</label>
            <input type="number" class="form-control" id="desconto" name="desconto" min="1" max="100" required>
        </div>
        <div class="mb-3">
            <label for="validade" class="form-label">Validade</label>
            <input type="date" class="form-control" id="validade" name="validade" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Cupom</button>
    </form>
</div>
</body>
</html>