<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return view('app.produto');
    }
}
