<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato()
    {   
        return view('site.contato', ['titulo'=>'Contato']);
    }

    public function salvar(Request $request)
    {
        // Instanciando a model SiteContato
        // $contato = new SiteContato();
        
        /*
        // preenchendo os atributos manualmente
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem'); 
        */

        // preenchendo automaticamente com o método fill() e recuperando todos os atributos com $request->all()
        // $contato->fill($request->all());

        // salvando no banco de dados
        // $contato->save();

        // debug is on the table:
        //print_r($contato->getAttributes());

        // -----------------------------------------------------------------------------------------------------
        // Outra forma mais enxuta

        // validação dos campos
        $request->validate([
            'nome' => 'min:3|max:50', // required está implícito
            'telefone' => 'required',
            'email' => 'required',
            'motivo_contato' => 'required',
            'mensagem' => 'required|max:3000'
        ]);

        // criando e salvando os registros no banco de dados
        SiteContato::create($request->all());

        return view('site.contato', ['titulo'=>'Contato']);
    }
}
