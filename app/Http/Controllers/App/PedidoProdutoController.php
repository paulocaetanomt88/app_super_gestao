<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        $pedido->produtos; // eager loading

        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'pedido_id' => 'exists:pedidos,id',
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required|integer'
        ];

        $feedback = [
            'pedido_id.exists' => 'O pedido informado não existe',
            'produto_id.exists' => 'O produto informado não existe',
            'required' => 'O :attribute deve ser preenchido.',
            'integer' => 'O :attribute deve ser um número inteiro.'
        ];

        $request->validate($regras, $feedback);
        /*
            $pedido_produto = new PedidoProduto();
            $pedido_produto->pedido_id = $pedido->id;
            $pedido_produto->produto_id = $request->get('produto_id');
            $pedido_produto->quantidade = $request->get('quantidade');
            $pedido_produto->save()
        */

        // relação de produtos para enviar à view
        $produtos = Produto::all();

       // pegando apenas o nome do produto a ser inserido
       $produto = Produto::select('nome')->where('id', $request->get('produto_id'))->get(); 



        /*
         Inserindo registros por meio do relacionamento
         chamando ->produtos em formato de atributo o Laravel retorna os registros desse relacionamento;
         chamando ->produtos() em formato de método o Laravel cria um objeto que mapeia esse relacionamento;
         a função ->attach() permite adicionar as informações que devem ser inseridas à tabela que guarda as relações de N:N;
         'pedido_id' já está contido dentro da instância do objeto $pedido portanto não precisa ser passado via parâmetro;
         o primeiro parâmetro, então, é 'produto_id' que é a chave estrangeira para Produto;
         o segundo parâmetro é um array contendo as colunas e valores que precisamos inserir, que neste caso é 'quantidade' e se houvessem mais seriam passadas neste;
        
        $insere = $pedido->produtos()->attach(
            $request->get('produto_id'),
            ['quantidade' => $request->get('quantidade')]
        );

        */

        // Dessa mesma forma, podemos inserir vários registros passando um array para a função attach()
        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]);

        $msg = 'Produto '. $produto[0]->nome .' foi incluído no pedido com sucesso.';

        return view('app.pedido_produto.create',['pedido'=>$pedido, 'produtos' => $produtos, 'msg'=>$msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PedidoProduto  $pedidoProduto
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoProduto $pedidoProduto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PedidoProduto  $pedidoProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(PedidoProduto $pedidoProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PedidoProduto  $pedidoProduto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoProduto $pedidoProduto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PedidoProduto  $pedidoProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido, Produto $produto, Request $request)
    {
        // Método convencional
        /*
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
        ])->delete();
        */

        // Método detach
        // $pedido->produtos()->detach($produto->id);
        
        // relação de produtos para enviar à view
        $produtos = Produto::all();

        $pedido_produto = PedidoProduto::where('id',$request->id_pedido_produto);

        // Excluindo pela PK de pedidos_produtos
        $exclui = $pedido_produto->delete();

       if($exclui) {
        $msg = 'Produto '. $produto->nome .' foi removido do pedido.';
    } else {
        $msg = 'O produto '. $produto->nome .' <b>não foi removido</b> do pedido.';
    }

        return view('app.pedido_produto.create',['pedido'=>$pedido, 'produtos' => $produtos, 'msg'=>$msg]);
    }
}
