<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'imagem', 'thumbnail', 'data_inicio', 'data_fim', 'dia_unico', 'local', 'user_id',
        'capacidade', 'preco', 'status_id'];

        protected $table = "evento";
}
