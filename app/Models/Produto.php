<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto';
    
    protected $fillable = [
        'nome_produto',
        'valor_produto',
        'id_categoria_produto'
    ];

    public function categoria() {
        return $this->belongsToMany(CategoriaProduto::class);
    }
}
