<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

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
}
