<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {   
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo'=>'Contato', 'motivo_contatos'=>$motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        // validação dos campos
        $regras = [
            'nome' => 'required|min:3|max:50|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:3000'
        ];

        $feedback = [
            'nome.required' => 'O campo nome é necessário.',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo nome precisa ter no máximo 50 caracteres.',
            'nome.unique' => 'O nome informado já foi utilizado.',
            'telefone.required' => 'O campo telefone é necessário.',
            'email.email' => 'Informe um email em formato válido',
            'motivo_contatos_id.required' => 'O campo motivo de contato é necessário.',
            'mensagem.required' => 'O campo mensagem é necessário.',
            'mensagem.max' => 'O campo mensagem deve ter no máximo 3000 caracteres.',
        ];

        $request->validate($regras, $feedback);

        // criando e salvando o registro no banco de dados
        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}
