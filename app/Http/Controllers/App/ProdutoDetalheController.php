<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

use App\Models\ItemDetalhe;

use App\Models\Unidade;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itens_detalhes = ItemDetalhe::paginate(10);

        return view('app.produto_detalhe.index', ['itens_detalhes' => $itens_detalhes, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();

        return view('app.produto_detalhe.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ItemDetalhe::create($request->all());
        echo "Detalhes do produto cadastrados com sucesso.";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item_detalhe = ItemDetalhe::findOrFail($id);

        $unidade = Unidade::findOrFail($item_detalhe->unidade_id);

        return view('app.produto_detalhe.show', ['item_detalhe' => $item_detalhe, 'unidade' => $unidade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $item_detalhe = ItemDetalhe::findOrFail($id);

    $item = Item::findOrFail($item_detalhe->produto_id);

    $unidades = Unidade::all();

    return view('app.produto_detalhe.edit', ['item_detalhe' => $item_detalhe, 'item' => $item, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemDetalhe $item_detalhe)
    {
        if($item_detalhe->update($request->all())) {
            $msg = 'Os detalhes do produto foram atualizados com sucesso!';
        } else {
            $msg = 'Falha ao atualizar detalhes do produto!';
        }

        // return "Os detalhes do produto foram atualizados com sucesso!";
        // return redirect()->route('produto-detalhe.show', ['msg' => $msg, 'produto_detalhe' => $produto_detalhe]);

        $unidades = Unidade::all();

        return view('app.produto_detalhe.edit', ['item_detalhe' => $item_detalhe, 'unidades' => $unidades, 'msg' => $msg]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item_detalhe = ItemDetalhe::findOrFail($id);
        
        $item_detalhe->delete();
        
        return redirect()->back();
    }
}
