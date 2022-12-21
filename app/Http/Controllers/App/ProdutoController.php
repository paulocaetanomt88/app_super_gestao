<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*  // Com filtros de busca
            $produtos = Produto::where('nome','like','%'.$request->input('nome').'%')
            ->where('descricao','like','%'.$request->input('descricao').'%')
            ->where('peso','like','%'.$request->input('peso').'%')
            ->where('unidade_id','like','%'.$request->input('unidade_id').'%')
            ->paginate(3); 
        */

        $produtos = Produto::has('produtoDetalhe')->has('unidade')->paginate(10);
        $unidades = Unidade::all();

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();

        return view('app.produto.create', ['unidades' => $unidades]);
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
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|numeric|between:0.01,9999.99',
            'unidade_id' => 'exists:unidades,id' // precisa existir o registro na tabela e coluna indicadas.
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres.',
            'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres.',
            'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres.',
            'peso.numeric' => 'O campo peso precisa ser numérico.',
            'peso.between' => 'O campo peso precisa estar entre 0.01 e 9999.99.',
            'unidade_id.exists' => 'A unidade de medida selecionada não existe'
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        $unidade = Unidade::findOrFail($produto->unidade_id);

        return view('app.produto.show', ['produto' => $produto, 'unidade' => $unidade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();

        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|numeric|between:0.01,9999.99',
            'unidade_id' => 'exists:unidades,id' // precisa existir o registro na tabela e coluna indicadas.
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres.',
            'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres.',
            'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres.',
            'peso.numeric' => 'O campo peso precisa ser numérico.',
            'peso.between' => 'O campo peso precisa estar entre 0.01 e 9999.99.',
            'unidade_id.exists' => 'A unidade de medida selecionada não existe'
        ];

        $request->validate($regras, $feedback);

        $produto->nome = $request->input('nome');
        $produto->descricao = $request->input('descricao');
        $produto->peso = $request->input('peso');
        $produto->unidade_id = $request->input('unidade_id');

        if ($produto->update())
            $msg = 'Produto atualizado com sucesso!';
        else
            $msg = 'Falha ao atualizar o produto!';

        $unidades = Unidade::all();

        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'msg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        
        return redirect()->back();
    }
}
