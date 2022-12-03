<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\MotivoContato;
use Illuminate\Http\Request;


class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('log.acesso');
    }

    public function principal()
    {
        $motivo_contatos = MotivoContato::all();

        return view("site.principal", ['titulo'=>'Principal', 'motivo_contatos' => $motivo_contatos]);
    }
}
