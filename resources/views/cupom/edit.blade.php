@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h2 class="mb-4">Editar <span class="span-texto-criar">Cupom<span></h2>
        <form action="{{ route('cupons.update', $cupom->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="text" class="form-control" id="codigo" name="codigo" value="{{$cupom->codigo}}" placeholder="Codigo" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="desconto" name="desconto" min="1" max="100" value="{{$cupom->desconto}}" placeholder="Desconto" required>
            </div>
            <div class="mb-3">
                <input type="datetime-local" class="form-control" id="validade" name="validade" value="{{$cupom->validade}}" placeholder="Válido até: " required>
            </div>
            <div class="mb-3">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ativo" id="flexCheckChecked" @checked(old('ativo', $cupom->ativo))>
                <label class="form-check-label" for="flexCheckChecked">
                    Ativo
                </label>
                </div>
            </div>

            <button type="submit" class="btn btn-salvar">Salvar</button>
        </form>
    </div>
@endsection