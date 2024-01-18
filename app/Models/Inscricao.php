<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'evento_id', 'status_id', 'forma_pagamento_id'];

    protected $table = "inscricao";

    public function usuario(){
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function evento(){
        return $this->belongsTo('\App\Models\Evento');
    }

    public function status(){
        return $this->belongsTo('\App\Models\Status');
    }

    public function pagamento(){
        return $this->hasOne('\App\Models\Pagamento');
    }

    public function rules(){
        return [
            'user_id' => 'required|exists:users,id',
            'evento_id' => 'required|exists:evento,id',
            'forma_pagamento_id' => 'required|exists:forma_pagamento,id',
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'O registro não existe'
        ];
    }
}
