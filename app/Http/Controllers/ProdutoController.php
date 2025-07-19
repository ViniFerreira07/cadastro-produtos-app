<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produto.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'qtd_estoque' => 'nullable|integer|min:0',
        ]);

        $produto = new Produto();
        $produto->nome = $validated['nome'];
        $produto->preco = $validated['preco'];
        $produto->descricao = $validated['descricao'] ?? '';
        $produto->qtd_estoque = $validated['qtd_estoque'] ?? 0;
        $produto->estoque()->associate($validated['estoque_id'] ?? null);

        $this->updateOnEstoque($produto);

        $produto->save();

        session()->flash('success', 'Produto criado com sucesso!');
        return redirect()->route('produtos.index');
    }

    public function updateOnEstoque(Produto $produto)
    {
        $estoque = new Estoque();
        $estoque->nome_produto = $produto->nome;
        $estoque->quantidade = $produto->qtd_estoque ?? 0;
        $estoque->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produto = Produto::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'qtd_estoque' => 'nullable|integer|min:0',
        ]);

        $produto->nome = $validated['nome'];
        $produto->preco = $validated['preco'];
        $produto->descricao = $validated['descricao'] ?? '';
        $produto->qtd_estoque = $validated['qtd_estoque'] ?? 0;
        $produto->save();

        session()->flash('success', 'Produto atualizado com sucesso!');
        return redirect()->route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        session()->flash('success', 'Produto excluído com sucesso!');
        return redirect()->route('produtos.index');
    }
}
