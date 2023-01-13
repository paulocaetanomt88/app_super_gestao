<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // tabela mapeada pelo model
    protected $table = "produtos";

    protected $fillable = ['fornecedor_id', 'nome', 'descricao', 'peso', 'unidade_id'];

    public function itemDetalhe() {
        return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');
    }

    public function unidade() {
        return $this->belongsTo(Unidade::class, 'unidade_id',  'id');
    }

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id',  'id');
    }

    public function pedidos() {
        /*
            Forma usando model não-convencional
            Parâmetros:
            1 - Model do relacionamento N:N em relação a Model que estamos implementando
            2 - Nome da Tabela auxiliar que armazena os registros de relacionamento
            3 - Nome da Chave Extrangeira (FK 'produto_id') da tabela mapeada (produtos) por este model (Item::class) na tabela de relacionamento (pedidos_produtos)
            4 - Nome da Chave Extrangeira (FK 'pedido_id') da tabela mapeada (pedidos) pelo model utilizado (Pedido::class) no relacionamento que estamos implementando (pedidos_produtos) 
        */
        return $this->belongsToMany(Pedido::class, 'pedidos_produtos', 'produto_id', 'pedido_id');
    }
}
