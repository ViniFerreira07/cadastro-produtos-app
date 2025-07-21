@extends('layouts.app')

@section('content')
<div class="container p-3">
    <h2 class="mb-4">Editar <span class="span-texto-criar">Cliente<span></h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="cadastrar-cliente" action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row gx-3">
            <div class="col-4 section-cliente-dados p-3">
                <h5>Dados pessoais</h5>
                <div class="mb-3">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required value="{{ old('nome', $cliente->nome) }}">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value="{{ old('email', $cliente->email) }}">
                </div>
            </div>

            <div class="row col-8 section-cliente-endereco ms-1 p-3">
                <div class="col-6">
                    <h5>Endereço</h5>
                    <div class="mb-3">
                        <input type="text" name="cep" id="cep" class="form-control" maxlength="9" placeholder="CEP" required value="{{ old('cep',$cliente->cep) }}">
                        <button type="button" id="btnVerificarCep" class="btn btn-secondary btn-sm mt-3">Verificar Endereço</button>
                        <span id="enderecoResultado" class="ms-2"></span>
                    </div>
                </div>

                <div class="col-6">
                    <div>
                        <div class="mb-3">
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="Numero" required value="{{ old('numero', $cliente->numero) }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="rua" id="rua" class="form-control" placeholder="Rua" required value="{{ old('rua', $cliente->rua) }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro" required value="{{ old('bairro',$cliente->bairro) }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" required value="{{ old('cidade', $cliente->cidade) }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="estado" id="estado" class="form-control" placeholder="Estado" maxlength="2" required value="{{ old('estado', $cliente->estado) }}">
                        </div>
                        <input type="hidden" name="pedido_id" value="{{ $pedido_id ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-salvar mt-3">Editar</button>
        </div>
    </form>
</div>
@endsection