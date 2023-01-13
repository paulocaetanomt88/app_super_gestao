<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id'];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function produtos() {
        // Forma convencional
        // return $this->belongsToMany(Produto::class, 'pedidos_produtos');

        /* 
            Forma usando model não-convencional
            Parâmetros:
            1 - Model do relacionamento N:N em relação a Model que estamos implementando
            2 - Nome da Tabela auxiliar que armazena os registros de relacionamento
            3 - Nome da Chave Extrangeira (FK) da tabela mapeada pelo model na tabela de relacionamento
            4 - Nome da Chave Extrangeira (FK) da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */
        return $this->belongsToMany(Item::class, 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at','quantidade');
    }
}
