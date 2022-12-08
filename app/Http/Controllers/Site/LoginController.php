<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';


        if ($request->get('erro') == 1)
        {
            $erro = 'Usuário ou senha inválido.';
        }

        return view('site.login', ['titulo' => 'Autenticação de usuário', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        $regras = [
            'usuario' => 'required|email',
            'senha' => 'required'
        ];

        $feedback = [
            'usuario.required' => 'O campo usuário (e-mail) é obrigatório.',
            'usuario.email' => 'O campo usuário (e-mail) não está em um formato válido.',
            'senha.required' => 'O campo senha é obrigatório.'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        // Instanciando a Model User
        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name))
        {
            echo 'Usuário existe.';
        } else {
            // redirecionando para tela de login com mensagem de erro via parâmetro
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }
}
