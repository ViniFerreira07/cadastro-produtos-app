<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estoques = Estoque::all();
        return view('estoque.index', compact('estoques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estoque.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $estoque = new Estoque();
        $estoque->quantidade = $validated['quantidade'];
        $estoque->save();

        session()->flash('success', 'Estoque criado com sucesso!');
        return redirect()->route('estoque.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estoque = Estoque::findOrFail($id);
        return view('estoque.show', compact('estoque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $estoque = Estoque::findOrFail($id);
        return view('estoque.edit', compact('estoque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $estoque = Estoque::findOrFail($id);

        $validated = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $estoque->produto_id = $validated['produto_id'];
        $estoque->quantidade = $validated['quantidade'];
        $estoque->quantidade_minima = $validated['quantidade_minima'] ?? 0;
        $estoque->save();

        session()->flash('success', 'Estoque atualizado com sucesso!');
        return redirect()->route('estoque.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        session()->flash('success', 'Estoque excluído com sucesso!');
        return redirect()->route('estoque.index');
    }
}
