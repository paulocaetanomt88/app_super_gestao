<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // criando a coluna em produtos que vai receber a chave estrangeira (id) de fornecedores
        Schema::table('produtos', function (Blueprint $table) {
            // insere um registro de fornecedor padrão para estabelecer o relacionamento 
            $fornecedor_id = DB::table('fornecedores')->insertGetId([
                'nome' => 'Fornecedor Padrão',
                'site' =>  'www.fornecedorpadraoxyz.com.br',
                'uf' => 'SP',
                'email' => 'contato@fornecedorpadraoxyz.com.br'
            ]);

            // 
            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });   
    }
};
