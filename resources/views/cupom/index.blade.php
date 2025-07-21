@extends('layouts.app')

@section('content')
<div class="container p-5 table-responsive">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mt-3 mb-3 me-5">Cupons</h2>
        <div>
            <a href="{{ route('cupons.create') }}" class="btn btn-create"><i class="bi bi-plus-circle-fill me-2"></i>Criar</a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Desconto (%)</th>
                <th>Validade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cupons as $cupom)
                <tr>
                    <td>{{ $cupom->id }}</td>
                    <td>{{ $cupom->codigo }}</td>
                    <td>{{ $cupom->desconto }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($cupom->validade)->timezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
                        <br>
                        <small class="text-white">
                            <span class="contador-tempo"
                                data-validade="{{ \Carbon\Carbon::parse($cupom->validade)->timezone('America/Sao_Paulo')->format('Y-m-d\TH:i:sP') }}">
                                Carregando...
                            </span>
                        </small>
                    </td>

                    <td>
                        @if($cupom->ativo)
                            <span class="text-success">Ativo</span>
                        @else
                            <span class="text-danger">Aplicado</span>
                        @endif
                    </td>
                    
                    <td>
                        <a href="{{ route('cupons.edit', $cupom->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('cupons.destroy', $cupom->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum cupom encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $cupons->links() }}
</div>
@endsection

@section('scripts')
    <script>
        function atualizarContadores() {
            const elementos = document.querySelectorAll('.contador-tempo');

            elementos.forEach(el => {
                const validadeStr = el.getAttribute('data-validade');
                const validade = new Date(validadeStr);

                const agoraUTC = new Date();
                const agoraBrasil = new Date(agoraUTC.toLocaleString("en-US", {timeZone: "America/Sao_Paulo"}));

                const diff = validade - agoraBrasil;

                if (diff <= 0) {
                    el.innerText = 'Expirado';
                    el.classList.add('text-danger');
                    return;
                }

                const dias = Math.floor(diff / (1000 * 60 * 60 * 24));
                const horas = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutos = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const segundos = Math.floor((diff % (1000 * 60)) / 1000);

                let partes = [];
                if (dias > 0) partes.push(`${dias}d`);
                if (horas > 0 || dias > 0) partes.push(`${horas}h`);
                partes.push(`${minutos}m`);
                partes.push(`${segundos}s`);

                el.innerText = partes.join(' ');
            });
        }

        setInterval(atualizarContadores, 1000);
        atualizarContadores();
    </script>
@endsection