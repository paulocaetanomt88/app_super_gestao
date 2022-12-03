<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    /* 
    // Implementando o middleware no método construtor do SobreNosController
    public function __construct()
    {
        $this->middleware(LogAcessoMiddleware::class);
    }
    */

    public function sobreNos()
    {
        return view("site.sobre-nos", ['titulo'=>'Sobre nós']);
    }
}
