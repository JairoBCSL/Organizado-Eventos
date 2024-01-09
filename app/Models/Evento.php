<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'data_inicio', 'data_fim', 'local', 'user_id',
        'capacidade', 'preco', 'status_id'];
}
