<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Variacao;
use Illuminate\Http\Request;

class VariacaoController extends Controller
{
    public function index()
    {
        $variacoes = Variacao::paginate(5);

        return view('variacao.index', compact('variacoes'));
    }
    public function create()
    {
        $produtos = Produto::all();

        return view('variacao.create', compact('produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'produto_id' => 'required|exists:produtos,id',
            'qtd_estoque' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $qtd_estoque = Estoque::where('produto_id','=', $request->produto_id)->first()->quantidade;
                    $variacoes = Variacao::where('produto_id', $request->produto_id)->get();
                    $qtd_total_variacoes = 0;

                    if(!empty($variacoes)) {
                        foreach($variacoes as $variacao) {
                            $qtd_total_variacoes += $variacao->qtd_estoque;
                        }
                    }

                    if ($value > $qtd_estoque || $qtd_estoque < ($qtd_total_variacoes + $value)) {
                        $fail("A quantidade não pode ser maior que o estoque do produto ({$qtd_estoque}) e de suas variações ({$qtd_total_variacoes})");
                    }
                }
            ]
        ]);

        $variacao = new Variacao();
        $variacao->nome = $validated['nome'];
        $variacao->descricao = $validated['descricao'] ?? '';
        $variacao->qtd_estoque = $validated['qtd_estoque'] ?? 0;
        $variacao->produto_id = $validated['produto_id'];

        $variacao->save();

        $this->updateOnEstoque($variacao);

        session()->flash('success', 'Variação cadastrada com sucesso!');
        return redirect()->route('variacoes.index');
    }

    public function updateOnEstoque(Variacao $variacao)
    {
        $estoque = new Estoque();
        $estoque->nome_produto = $variacao->nome;
        $estoque->quantidade = $variacao->qtd_estoque ?? 0;
        $estoque->variacao()->associate($variacao);
        $estoque->produto_id = $variacao->produto_id;

        $estoque->save();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variacao = Variacao::findOrFail($id);
        $produtos = Produto::all();
        return view('variacao.edit', compact('variacao', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $variacao = Variacao::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'produto_id' => 'required|exists:produtos,id',
            'qtd_estoque' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $qtd_estoque = Estoque::where('produto_id','=', $request->produto_id)->first()->quantidade;
                    $variacoes = Variacao::where('produto_id', $request->produto_id)->get();
                    $qtd_total_variacoes = 0;

                    foreach($variacoes as $variacao) {
                        $qtd_total_variacoes += $variacao->qtd_estoque;
                    }

                    if ($value > $qtd_estoque || $qtd_estoque < ($qtd_total_variacoes + $value)) {
                        $fail("A quantidade não pode ser maior que o estoque do produto ({$qtd_estoque}) e de suas variações ({$qtd_total_variacoes})");
                    }
                }
            ]
        ]);
        
        $variacao->nome = $validated['nome'];
        $variacao->descricao = $validated['descricao'] ?? '';
        $variacao->qtd_estoque = $validated['qtd_estoque'] ?? 0;
        $variacao->produto_id = $request->input('produto_id');

        $variacao->save();
        return redirect()->route('variacoes.index')->with('success', 'Variação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variacao = Variacao::findOrFail($id);
        $variacao->delete();

        session()->flash('success', 'Variação excluída com sucesso!');
        return redirect()->route('variacoes.index');
    }

    public function show($variacao_id)
    {
        $variacao = Variacao::find($variacao_id);
        $nome_produto = Produto::find($variacao_id);
        return view('variacao.show', compact('variacao', 'nome_produto'));
    }
}
?>