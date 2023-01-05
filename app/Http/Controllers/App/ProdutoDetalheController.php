<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\ItemDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

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
        
        return redirect()->back()->with('msg', 'Detalhes do produto foram cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemDetalhe  $itemDetalhe
     * @return \Illuminate\Http\Response
     */
    public function show(ItemDetalhe $itemDetalhe)
    {
        //dd($itemDetalhe);
        
        $unidade = Unidade::findOrFail($itemDetalhe->unidade_id);

        return view('app.produto_detalhe.show', ['item_detalhe' => $itemDetalhe, 'unidade' => $unidade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemDetalhe  $itemDetalhe
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemDetalhe $itemDetalhe)
    {
        $itemDetalhe = ItemDetalhe::with(['item'])->find($itemDetalhe->id);

        $unidades = Unidade::all();

        return view('app.produto_detalhe.edit', ['item_detalhe' => $itemDetalhe, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemDetalhe  $itemDetalhe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemDetalhe $itemDetalhe)
    {
        if($itemDetalhe->update($request->all())) {
            $msg = 'Os detalhes do produto foram atualizados com sucesso!';
        } else {
            $msg = 'Falha ao atualizar detalhes do produto!';
        }

        // return "Os detalhes do produto foram atualizados com sucesso!";
        // return redirect()->route('produto-detalhe.show', ['msg' => $msg, 'produto_detalhe' => $produto_detalhe]);

        $unidades = Unidade::all();

        return view('app.produto_detalhe.edit', ['item_detalhe' => $itemDetalhe, 'unidades' => $unidades, 'msg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemDetalhe  $itemDetalhe
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemDetalhe $itemDetalhe)
    {
        $itemDetalhe->delete();
        
        return redirect()->back()->with('msg', 'Detalhes do produto foram apagados!');
    }
}
