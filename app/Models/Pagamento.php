<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = ['valor', 'inscricao_id', 'evento_id', 'forma_pagamento_id', 'status_id', 'data'];
}
