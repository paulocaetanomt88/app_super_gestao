<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $metodo_autenticacao, $perfil, $p3, $p4)
    {
        // verifica se o usuário possui acesso a rota
        echo $metodo_autenticacao .' '. $perfil .'<br>';

        if ($metodo_autenticacao == 'padrao')
            echo 'verificar o usuário e a senha no banco de dados ' .$perfil. '<br>';

        if ($metodo_autenticacao == 'ldap')
            echo 'verificar o usuário e a senha no AD ' .$perfil. '<br>';

        if ($perfil == 'visitante')
            echo 'exibir apenas alguns recursos <br>';
        else 
            echo 'Carregar perfil do banco de dados <br>';

        if(false)
        {
            return $next($request);
        }
        else
        {
            return Response('Acesso negado! Rota exige autenticação.');
        }
        
    }
}
