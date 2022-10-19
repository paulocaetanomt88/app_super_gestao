<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Método exemplo 01
        // criando uma instancia da model Fornecedor
        $fornecedor = new Fornecedor();

        // definindo os atributos
        $fornecedor->nome = "Fornecedor ABC";
        $fornecedor->site = "www.fornecedorabc.com.br";
        $fornecedor->uf = "MT";
        $fornecedor->email = "fornecedorabc@gmail.com";

        // salvando na base de dados
        $fornecedor->save();

        
        // Método exemplo 02
        // utilizando o método ::create() que vem da classe super classe Model, a qual a classe filha Fornecedor extende
        // definindo os atributos através de um array associativo
        Fornecedor::create([
            'nome' => 'Fornecedor XYZ',
            'site' => 'www.fornecedorxyz.com.br',
            'uf' => 'RJ',
            'email' => 'fornecedorxyz@gmail.com'
        ]);

        // Método exemplo 03
        // utilizando a classe DB, chamando o método estático table() com seu método insert()
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor MVC',
            'site' => 'www.fornecedormvc.com.br',
            'uf' => 'SP',
            'email' => 'fornecedormvc@gmail.com'
        ]);
    }
}
