<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'titulo', 'descricao', 'imagem', 'thumbnail', 'data_inicio', 'data_fim', 'dia_unico', 'local_id', 'user_id',
        'capacidade', 'preco', 'status_id', 'qrcode'];

    protected $table = "evento";

    public function local(){
        return $this->belongsTo('\App\Models\Local');
    }

    public function status(){
        return $this->belongsTo('\App\Models\Status');
    }

    public function inscricoes(){
        return $this->hasMany('\App\Models\Inscricao');
    }

    public function rules(){
        return [
            'titulo' => 'required|min:3|max:255',
            'descricao' => 'required|min:3|max:2550',
            'imagem' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date',
            'local_id' => 'required',
            'user_id' => 'required|exists:users,id',
            'capacidade' => 'required|integer',
            'preco' => 'required|numeric',
            'qrcode' => 'required|min:3|max:255'
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'O registro não existe',
            'date' => 'Formato de data inválido',
            'numeric' => 'O valor do campo precisa ser numérico',
            'integer' => 'O valor do campo precisa ser inteiro',
            'mimes' => 'Formato incorreto de arquivo',
            'min' => 'O número mínimo de carateres é :min é obrigatório',
            'max' => 'O número máximo de carateres é :max é obrigatório',

        ];
    }
}
