<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // manipular a requisição $request
        
        // o método $next empurra a requisção pra frente
        //
        
        //dd($request->server->get('REQUEST_URI'));
        $ip = $_SERVER['REMOTE_ADDR'];
        $rota = $request->server->get('REQUEST_URI');

        // Registrando o logo de acesso no banco de dados
        LogAcesso::create(['log' => 'IP: '.$ip.' requisitou a rota '.$rota]);

        $resposta = $next($request);

        $resposta->setStatusCode(201, 'O status e o texto da resposta foram modificados');

        dd($resposta);

        //return $next($request);
        //return Response('Chegamos no middleware e finalizamos aqui.');
    }
}
