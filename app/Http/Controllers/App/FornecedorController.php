<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {

        /*  vários
            $fornecedores = [
                'Atacadão',
                'Fort',
                'Açaí',
                'Nestle',
                'Coca-cola',
                'Pepsi',
                'Mabel',
                'Brahma',
                'Skol',
                'Itaipava',
                'Heineken'
            ];
        */
        // 3 $fornecedores = ['Atacadão', 'Fort', 'Açaí'];
        // 0 $fornecedores = [];

        // chaves nomeadas
        $fornecedores = [
            0 => ['nome' => 'Coca-Cola', 'status' => 'S', 'cnpj' => '45.997.418/0001-53'],
            1 => ['nome' => 'Pepsi', 'status' => 'S', 'cnpj' => '00.098.693/0001-05'],
            2 => ['nome' => 'Marajá', 'status' => 'N', 'cnpj' => '0'],
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
