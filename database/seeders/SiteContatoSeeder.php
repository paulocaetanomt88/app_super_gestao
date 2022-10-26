<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteContato;
use Database\Factories\SiteContatoFactory;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        // criando a instancia da model
        $site_contato = new SiteContato();

        // definindo atributos 
        $site_contato->nome = 'Paulo Caetano';
        $site_contato->telefone = '(65) 99999-9999';
        $site_contato->email = 'paulo@gmail.com';
        $site_contato->motivo_contato = 1;
        $site_contato->mensagem = 'Testando o SiteContatoSeeder da aula 118';

        // salvando na base de dados
        $site_contato->save();
        */

        SiteContato::factory(SiteContatoFactory::class, 100)->create();
    }
}