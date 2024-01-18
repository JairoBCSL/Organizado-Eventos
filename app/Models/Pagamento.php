<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inscricao_id', 'forma_pagamento_id', 'valor', 'status_id', 'comprovante'];

    protected $table = 'pagamento';

    public function inscricao(){
        return $this->belongsTo('\App\Models\Inscricao');
    }

    public function forma(){
        return $this->belongsTo('\App\Models\FormaPagamento');
    }

    public function status(){
        return $this->belongsTo('\App\Models\Status');
    }

    public function rules(){
        return [
            'inscricao_id' => 'required|exists:inscricao,id',
            'comprovante' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'O registro não existe',
            'mimes' => 'Formato incorreto de arquivo'
        ];
    }
}
