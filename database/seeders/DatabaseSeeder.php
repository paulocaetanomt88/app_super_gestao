<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use App\Models\SiteContato;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(FornecedorSeeder::class);
        // $this->call(SiteContatoSeeder::class);

        SiteContato::factory()->create();

        // \App\Models\Fornecedor::factory(100)->create();
    }
}
