<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $table = 'forma_pagamento';

    public function pagamentos(){
        return $this->hasMany('\App\Models\Pagamento');
    }
}
