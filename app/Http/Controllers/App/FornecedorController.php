<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome','like','%'.$request->input('nome').'%')
            ->where('site','like','%'.$request->input('site').'%')
            ->where('uf','like','%'.$request->input('uf').'%')
            ->where('email','like','%'.$request->input('email').'%')
            ->paginate(3);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all() ]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';
        
        if($request->input('_token') != '')
        {
            

            // validando campos recebidos do formulário
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'required|email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'nome.min' => 'O campo Nome deve ter no mínimo 3 letras.',
                'nome.max' => 'O campo Nome deve ter no máximo 40 letras.',
                'uf.min' => 'O campo UF deve ter no mínimo 2 letras.',
                'uf.max' => 'O campo UF deve ter no máximo 2 letras.',
                'email.email' => 'O campo e-mail não está em um formato válido.'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();

            if ($fornecedor->create($request->all()))
                $msg = 'Fornecedor cadastrado com sucesso!';
            else
                $msg = 'Falha ao cadastrar o fornecedor!';

            
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);        
    }

    public function editar($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        return view('app.fornecedor.editar', ['fornecedor' => $fornecedor]);
    }

    public function atualizar(Request $request)
    {
        $msg = '';
        
        if($request->input('_token') != '')
        {
            

            // validando campos recebidos do formulário
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'required|email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'nome.min' => 'O campo Nome deve ter no mínimo 3 letras.',
                'nome.max' => 'O campo Nome deve ter no máximo 40 letras.',
                'uf.min' => 'O campo UF deve ter no mínimo 2 letras.',
                'uf.max' => 'O campo UF deve ter no máximo 2 letras.',
                'email.email' => 'O campo e-mail não está em um formato válido.'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = Fornecedor::findOrFail($request->input('id'));

            $fornecedor->nome = $request->input('nome');
            $fornecedor->site = $request->input('site');
            $fornecedor->uf = $request->input('uf');
            $fornecedor->email = $request->input('email');

            if ($fornecedor->save())
                $msg = 'Fornecedor atualizado com sucesso!';
            else
                $msg = 'Falha ao atualizar o fornecedor!';
        }

        return view('app.fornecedor.editar', ['msg' => $msg, 'fornecedor'=>$fornecedor]);  
    }

    public function excluir($id)
    {
        $fornecedor = Fornecedor::findOrFail($id)->delete();

        return redirect()->back();
    }
}
