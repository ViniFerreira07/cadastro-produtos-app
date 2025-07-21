<?php

namespace App\Http\Controllers;

use App\Models\Cupom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cupons = Cupom::paginate(10);
        return view('cupom.index', compact('cupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cupom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|unique:cupons',
            'desconto' => 'required|numeric|min:0|max:100',
        ]);

        $cupom = new Cupom();
        $cupom->codigo = $validated['codigo'];
        $cupom->desconto = $validated['desconto'];
        $cupom->validade = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('validade'), 'America/Sao_Paulo')
                                   ->setTimezone('UTC');
        $cupom->ativo = $request->boolean('ativo');
        $cupom->save();

        session()->flash('success', 'Cupom criado com sucesso!');
        return redirect()->route('cupons.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cupom = Cupom::findOrFail($id);
        return view('cupom.show', compact('cupom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cupom = Cupom::findOrFail($id);
        return view('cupom.edit', compact('cupom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cupom = Cupom::findOrFail($id);

        $cupom->codigo = $request->input('codigo');
        $cupom->desconto = $request->input('desconto');
        $cupom->validade = $request->input('validade');
        $cupom->ativo = $request->boolean('ativo');
        $cupom->save();

        session()->flash('success', 'Cupom atualizado com sucesso!');
        return redirect()->route('cupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cupom = Cupom::findOrFail($id);
        $cupom->delete();

        session()->flash('success', 'Cupom excluído com sucesso!');
        return redirect()->route('cupons.index');
    }
}
