<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::paginate();
        $pedidos = Pedido::all();

        return view('app.cliente.index', ['clientes' => $clientes, 'pedidos' => $pedidos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:50',
            'telefone' => 'required|min:14|max:16',
            'email' => 'required|email',
            'endereco' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 3 letras.',
            'nome.max' => 'O campo nome deve ter no máximo 50 letras.',
            'telefone.min' => 'O campo telefone não está em formato válido.',
            'telefone.max' => 'O campo telefone não está em formato válido.',
            'email.email' => 'O campo email não está em formato válido.'
        ];

        $request->validate($regras, $feedback);

        $cliente = new Cliente();

        if($cliente->create($request->all())) {
            $msg = "Cliente cadastrado com sucesso!";
        } else {
            $msg = "Falha ao cadastrar o cliente.";
        }

        return view('app.cliente.create', ['msg' => $msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('app.cliente.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('app.cliente.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $regras = [
            'nome' => 'required|min:3|max:50',
            'telefone' => 'required|min:14|max:16',
            'email' => 'required|email',
            'endereco' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 3 letras.',
            'nome.max' => 'O campo nome deve ter no máximo 50 letras.',
            'telefone.min' => 'O campo telefone não está em formato válido.',
            'telefone.max' => 'O campo telefone não está em formato válido.',
            'email.email' => 'O campo email não está em formato válido.'
        ];

        $request->validate($regras, $feedback);

        if($cliente->update($request->all())) {
            $msg = "Cliente atualizado com sucesso!";
        } else {
            $msg = "Falha ao atualizar o cliente.";
        }

        return view('app.cliente.edit', ['msg' => $msg, 'cliente' => $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->back();
    }
}
