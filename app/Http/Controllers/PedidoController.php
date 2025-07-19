<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pedido.index');
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
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        $pedido = new Pedido();
        $pedido->quantidade = $validated['quantidade'];
        $pedido->preco_unitario = $validated['preco_unitario'];
        $pedido->valor_total = $validated['valor_total'];
        $pedido->save();

        foreach ($validated['produtos'] as $produto) {
            $pedido->produtos()->attach($produto['id'], ['quantidade' => $produto['quantidade']]);
        }

        session()->flash('success', 'Pedido criado com sucesso!');
        return redirect()->route('pedido.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedido.show', compact('pedido'));
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
}
