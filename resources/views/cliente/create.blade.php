@extends('layouts.app')

@section('content')
<div class="container p-3">
    <h2 class="mb-4">Cadastrar <span class="span-texto-criar">Cliente<span></h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($clientes))
        <div class="d-flex mb-3">
            <button type="button" id="btnCadastrarCliente" class="btn btn-select text-white me-2">Cadastrar Cliente</button>
            <button type="button" id="btnSelecionarCliente" class="btn btn-salvar">Selecionar Cliente</button>
        </div>

        <div class="select-cliente">
            <form action="{{route('cliente.cliente-cadastrado')}}" method="POST">
                @csrf
                <select class="form-select" name="cliente_id">
                    <option disabled selected>Selecione um cliente...</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                    @endforeach
                </select>

                @isset($valor_total)
                    <input type="hidden" name="valor_total" value="{{ $valor_total }}">
                @endif

                <button type="submit" class="btn btn-success mt-3">Finalizar</button>
            </form>
        </div>
    @endif

    <form class="cadastrar-cliente {{isset($clientes) ? 'd-none' : ''}}" action="{{ route(isset($clientes) ? 'cliente.storeCarrinho' : 'clientes.store') }}" method="POST">
        @csrf
        
        <div class="row gx-3">
            <div class="col-4 section-cliente-dados p-3">
                <h5>Dados pessoais</h5>
                <div class="mb-3">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required value="{{ old('nome') }}">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                </div>
            </div>

            <div class="row col-8 section-cliente-endereco ms-1 p-3">
                <div class="col-6">
                    <h5>Endereço</h5>
                    <div class="mb-3">
                        <input type="text" name="cep" id="cep" class="form-control" maxlength="9" placeholder="CEP" required value="{{ old('cep') }}">
                        <button type="button" id="btnVerificarCep" class="btn btn-secondary btn-sm mt-3">Verificar Endereço</button>
                        <span id="enderecoResultado" class="ms-2"></span>
                    </div>
                </div>

                <div class="col-6">
                    <div>
                        <div class="mb-3">
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="Numero" required value="{{ old('numero') }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="rua" id="rua" class="form-control" placeholder="Rua" required value="{{ old('rua') }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro" required value="{{ old('bairro') }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" required value="{{ old('cidade') }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="estado" id="estado" class="form-control" placeholder="Estado" maxlength="2" required value="{{ old('estado') }}">
                        </div>

                        <input type="hidden" name="pedido_id" value="{{ $pedido_id ?? '' }}">

                        @isset($valor_total)
                            <input type="hidden" name="valor_total" value="{{ $valor_total }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-salvar mt-3">Finalizar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('btnVerificarCep').addEventListener('click', function() {
    let cep = document.getElementById('cep').value;
    let resultado = document.getElementById('enderecoResultado');
    resultado.textContent = 'Consultando...';

    fetch('https://viacep.com.br/ws/' + cep.replace(/\D/g, '') + '/json/')
        .then(response => response.json())
        .then(data => {
            if (!data.erro) {
                document.getElementById('rua').value = data.logradouro || '';
                document.getElementById('bairro').value = data.bairro || '';
                document.getElementById('cidade').value = data.localidade || '';
                document.getElementById('estado').value = data.uf || '';
                resultado.textContent = 'Endereço encontrado!';
            } else {
                resultado.textContent = 'CEP não encontrado ou inválido.';
            }
        })
        .catch(() => {
            resultado.textContent = 'Erro ao consultar CEP.';
        });
});

const select = document.querySelector('.select-cliente');
const cadastrar = document.querySelector('.cadastrar-cliente');

document.getElementById('btnCadastrarCliente').addEventListener('click', function () {
    document.querySelector('.select-cliente').classList.add('d-none');
    document.querySelector('.cadastrar-cliente').classList.remove('d-none');
});

document.getElementById('btnSelecionarCliente').addEventListener('click', function () {
    document.querySelector('.cadastrar-cliente').classList.add('d-none');
    document.querySelector('.select-cliente').classList.remove('d-none');
});

</script>
@endsection