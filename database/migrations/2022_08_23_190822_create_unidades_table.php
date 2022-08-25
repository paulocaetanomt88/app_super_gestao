<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidade', 5);
            $table->string('descricao', 30);
            $table->timestamps();
        });

        // adiciona relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id')->before('created_at'); // cria o campo unidade_id na tabela produtos
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        // adiciona relacionamento com a tabela produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id')->before('created_at'); // cria o campo unidade_id na tabela produtos
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remove relacionamento com a tabela produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            // remove a chave estrangeira
            $table->dropForeign('produto_detalhes_unidade_id_foreign');

            // remove a coluna unidade_id em produto_detalhes
            $table->dropColumn('unidade_id');
        });

        // remove relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            // remove a chave estrangeira
            $table->dropForeign('produtos_unidade_id_foreign');

            // remove a coluna unidade_id
            $table->dropColumn('unidade_id');
        });

        Schema::dropIfExists('unidades');
    }
};
