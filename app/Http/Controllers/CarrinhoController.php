<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cupom;
use App\Models\Estoque;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function index(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        $valor_total = $this->calcularValorTotalSemDesconto();
        $frete = $this->calcularValorFrete($valor_total);
        return view('carrinho.index', compact('carrinho', 'frete'));
    }

    public function adicionar(Request $request, Produto $produto)
    {
        $quantidade = $request->input('quantidade', 1);
        $qtd_estoque = Estoque::where('produto_id', $produto->id)->first()->quantidade;

        if($quantidade > $qtd_estoque) {
            return redirect()->back()->with('erro_quantidade', 'Quantidade ultrapassa a disponível em estoque ('.$qtd_estoque.')' );
        }

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$produto->id])) {
            $carrinho[$produto->id]['quantidade'] += $quantidade;
        } else {
            $carrinho[$produto->id] = [
                'produto' => $produto,
                'quantidade' => $quantidade,
            ];
        }

        session(['carrinho' => $carrinho]);

        return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover(Request $request, Produto $produto)
    {
        $carrinho = session()->get('carrinho', []);
        unset($carrinho[$produto->id]);
        session(['carrinho' => $carrinho]);
        return redirect()->route('carrinho.index')->with('success', 'Produto removido do carrinho!');
    }
    public function atualizar(Request $request, Produto $produto)
    {
        $quantidade = $request->input('quantidade', 1);
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$produto->id])) {
            $carrinho[$produto->id]['quantidade'] = $quantidade;
            session(['carrinho' => $carrinho]);
            return redirect()->route('carrinho.index')->with('success', 'Quantidade atualizada!');
        }

        return redirect()->route('carrinho.index')->with('error', 'Produto não encontrado no carrinho!');
    }

    public function limpar()
    {
        session()->forget('carrinho');
        return redirect()->route('carrinho.index')->with('success', 'Carrinho limpo com sucesso!');
    }

    public function finalizar(Request $request)
    {
        $valor_total = 0;
        $carrinho = session()->get('carrinho', []);
        $cupom = session()->get('cupom', []);
        
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Carrinho vazio!');
        }

        if(!empty($cupom)) {
            $cupomModel = Cupom::where('codigo', $cupom['codigo'])->first();
            $cupomModel->ativo = false;
            $cupomModel->save();
            $valor_total = $cupom['totalComDesconto'];
        } else {
            $valor_total = $this->calcularValorTotalSemDesconto();
        }

        $clientes = Cliente::all();

        return view('cliente.create', compact('clientes', 'valor_total'));
    }

    public function calcularValorTotalSemDesconto() {
        $valor_total = 0;

        $carrinho = session()->get('carrinho', []);

        foreach($carrinho as $item) {
            $valor_total += $item['produto']->preco * $item['quantidade'];
        }

        return $valor_total;
    }
    
    public function calcularFrete(Request $request)
    {
        $valor_total = $request->input('total', 0);

        $frete = $this->calcularValorFrete($valor_total);

        return $frete;
    }

    public function calcularValorFrete($valor_total)
    {  
        $frete = 0;

        if ($valor_total < 52) {
            $frete = 20.00;
        } else if($valor_total >= 52 && $valor_total <= 162.59) {
            $frete = 15.00;
        } else {
            $frete = 0.00;
        }

        return $frete;
    }

    public function verificarCep(Request $request)
    {
        $cep = preg_replace('/[^0-9]/', '', $request->input('cep'));

        if(strlen($cep) !== 8) {
            return response()->json(['sucesso' => false]);
        }

        $response = @file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        $endereco = $response ? json_decode($response, true) : null;

        if ($endereco && empty($endereco['erro'])) {
            return response()->json([
                'sucesso' => true,
                'endereco' => $endereco
            ]);
        } else {
            return response()->json(['sucesso' => false]);
        }
    }

    public function aplicarCupom(Request $request)
    {
        $cupom = Cupom::where('codigo', $request->codigo)->whereDate('validade', '>=', now())->first();
        $valor_total = $request->input('valor_total', 0);

        if (!$cupom || !$cupom->ativo) {
            return back()->with('erro_cupom', 'Cupom inválido ou expirado.');
        }

        $valorDesconto = $cupom->desconto / 100 * $valor_total;

        $totalComDesconto = $valor_total - $valorDesconto;

        session()->put('cupom', [
            'codigo' => $cupom->codigo,
            'desconto' => $cupom->desconto,
            'totalComDesconto' => $totalComDesconto
        ]);

        return back();
    }
    public function removerCupom()
    {
        session()->forget('cupom');
        return back()->with('success', 'Cupom removido com sucesso!');
    }
}