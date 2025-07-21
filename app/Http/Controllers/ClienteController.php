<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Cliente;
use App\Models\Estoque;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::paginate(5);
        return view('cliente.index', compact('clientes'));
    }
    public function create()
    {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        $this->cadastrarCliente($request);
       
        session()->flash('success', 'Cliente cadastrado com sucesso!');
        return redirect()->route('produtos.index');
    }

    public function storeCarrinho(Request $request, Cliente $cliente) {
        $cliente = $this->cadastrarCliente($request);
        $valor_total = $request->input('valor_total');

        $this->setPedido($cliente->id, $valor_total);

        $emailController = new EmailController();
        $emailController->sendEmail($cliente['email'], $cliente['nome']);

        session()->forget('carrinho');
        session()->forget('cupom');

        session()->flash('success', 'Cliente cadastrado com sucesso!');
        return redirect()->route('clientes.index');
    }

    public function cadastrarCliente(Request $request) {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:clientes',
            'rua' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:10',
            'pais' => 'nullable|string|max:100',
        ]);

        $cliente = Cliente::create($validated);

        return $cliente;
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => ['required','string','email','max:255',
                         Rule::unique('clientes')->ignore($cliente->id),
                       ],
            'rua' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:10',
            'pais' => 'nullable|string|max:100',
        ]);

        $cliente->nome = $validated['nome'];
        $cliente->email = $validated['email'];
        $cliente->rua = $validated['rua'];
        $cliente->numero = $validated['numero'];
        $cliente->bairro = $validated['bairro'];
        $cliente->cidade = $validated['cidade'];
        $cliente->estado = $validated['estado'];
        $cliente->cep = $validated['cep'];

        $cliente->save();
       
        session()->flash('success', 'Cliente atualizado com sucesso!');
        return redirect()->route('clientes.index');
    }

    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.show', compact('cliente'));
    }

    public function setPedido($cliente_id, $valor_total) 
    {
        $pedido = new Pedido();
        
        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Carrinho vazio!');
        }

        $pedido->valor_total = $valor_total;
        $pedido->cliente_id = $cliente_id;
        
        $pedido->save();

        foreach ($carrinho as $item) {
            $valorTotalProduto = $item['produto']->preco * $item['quantidade'];
            
            $pedido->produtos()->attach($item['produto']->id, [
                'quantidade' => $item['quantidade'],
                'valor_total' => $valorTotalProduto
            ]);
        }

        $this->decrementarQuantidadeEstoque();

        return $pedido;
    }

    public function decrementarQuantidadeEstoque()
    {
        $carrinho = session()->get('carrinho', []);

        foreach ($carrinho as $item) {
            $produto_id = $item['produto']->id;

            $estoque = Estoque::where('produto_id', $produto_id)->first();
            $estoque->quantidade -= $item['quantidade'];
            $estoque->save();
        }
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        session()->flash('success', 'Cliente excluído com sucesso!');
        return redirect()->route('clientes.index');
    }

    public function setClienteCadastrado(Request $request) {
        $cliente_id = $request->input('cliente_id');
        $valor_total = $request->input('valor_total');

        $this->setPedido($cliente_id, $valor_total);

        session()->forget('carrinho');
        session()->forget('cupom');

        session()->flash('success', 'Pedido finalizado com sucesso!');
        return redirect()->route('produtos.index');
    }
}
