<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    /* 
    // Implementando o middleware no método construtor do SobreNosController 
    // *desta forma é necessário importar a classe com "use \App\Http\Middleware\LogAcessoMiddleware" aqui no SobreNosController
    public function __construct()
    {
        $this->middleware(LogAcessoMiddleware::class);
    }
    */
    
    // Implementando o middleware no Kernel com apelido
    // podemos chamar no SobreNosController pelo apelido especificado sem a necessidade de importar a classe pois já foi importada no kernel
    public function __construct()
    {
        $this->middleware('log.acesso');
    }

    public function sobreNos()
    {
        return view("site.sobre-nos", ['titulo'=>'Sobre nós']);
    }
}