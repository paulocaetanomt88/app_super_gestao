<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('site.login', ['titulo' => 'Autenticação de usuário']);
    }

    public function autenticar()
    {
        return 'chegamos até aqui!';
    }
}
