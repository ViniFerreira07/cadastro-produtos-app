@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h2 class="mb-4">Cadastrar <span class="span-texto-criar">Cupom<span></h2>
        <form action="{{ route('cupons.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="desconto" name="desconto" min="1" max="100" placeholder="Desconto" required>
            </div>
            <div class="mb-3">
                <input type="datetime-local" class="form-control" id="validade" name="validade" placeholder="Válido até: " required>
            </div>
            <div class="mb-3">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ativo" id="flexCheckChecked" value="1" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Ativo
                </label>
                </div>
            </div>

            <button type="submit" class="btn btn-salvar">Criar</button>
        </form>
    </div>
@endsection