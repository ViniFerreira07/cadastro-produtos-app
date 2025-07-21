<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::paginate(5);
        return view('pedido.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pedido.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'produtos.*.preco' => 'required|numeric|min:0',
        ]);

        $pedido = new Pedido();
        $pedido->cliente_id = $validated['cliente_id'];
        $pedido->valor_total = 0; // será somado abaixo
        $pedido->save();

        $valorTotalGeral = 0;

        foreach ($validated['produtos'] as $produto) {
            $valorTotalProduto = $produto['preco'] * $produto['quantidade'];
            $valorTotalGeral += $valorTotalProduto;

            $pedido->produtos()->attach($produto['id'], [
                'quantidade' => $produto['quantidade'],
                'preco' => $produto['preco'],
                'valor_total' => $valorTotalProduto
            ]);
        }

        // Atualiza o valor total do pedido
        $pedido->valor_total = $valorTotalGeral;
        $pedido->save();

        session()->flash('success', 'Pedido criado com sucesso!');
        return redirect()->route('pedido.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        $nome_cliente = Cliente::findOrFail($pedido->cliente_id)->nome;

        return view('pedido.show', compact('pedido', 'nome_cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedido.edit', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pedido::findOrFail($id);

        $validated = $request->validate([
            'quantidade' => 'required|integer|min:1',
            'preco_unitario' => 'required|numeric|min:0',
            'valor_total' => 'required|numeric|min:0',
        ]);

        $pedido->quantidade = $validated['quantidade'];
        $pedido->preco_unitario = $validated['preco_unitario'];
        $pedido->valor_total = $validated['valor_total'];
        $pedido->save();

        session()->flash('success', 'Pedido atualizado com sucesso!');
        return redirect()->route('pedido.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        session()->flash('success', 'Pedido excluído com sucesso!');
        return redirect()->route('pedido.index');
    }

    public function atualizarPedido($id, $status)
    {
        $status = strtolower($status);
        $statusPermitidos = ['pendente', 'verificando-pagamento', 'em-preparacao', 'em-curso', 'entregue', 'cancelado'];

        if (!in_array($status, $statusPermitidos)) {
            return response()->json(['erro' => 'Status invalido. Os status válidos são: pendente, verificando-pagamento, em-preparacao, em-curso, entregue, cancelado'], 400);
        }

        $status = str_replace('-', ' ', $status);

        $status = ucfirst($status);

        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json(['erro' => 'ID do pedido nao encontrado.'], 400);
        }

        $pedido->status = $status;
        $pedido->save();

        return response()->json(['sucesso' => true, 'mensagem' => 'Status do pedido atualizado com sucesso!']);
    }
}
