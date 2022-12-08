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
        } elseif ($request->get('erro') == 2) {
            $erro = 'É necessário autenticar-se para acessar a página requisitada.';
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

        // verifica se existe um usuário registrado com os dados informados no form. de login
        // se existir, os atributos deste usuário estarão acessíveis na instância $usuario
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        // verificando se o atributo email existe na instância
        if(isset($usuario->name))
        {
            // Habilitando o uso da superglobal $_SESSION
            session_start();

            // Criando variáveis dentro na sessão
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            // redirecionando para área restrita
            return redirect()->route('app.clientes');
        } else {
            // redirecionando para tela de login com mensagem de erro via parâmetro
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }
}
