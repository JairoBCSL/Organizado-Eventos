<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $table = 'local';

    public function cidade(){
        return $this->belongsTo('\App\Models\Cidade');
    }

    public function eventos(){
        return $this->hasMany('\App\Models\Evento');
    }

    public function rules(){
        return [
            'nome' => 'required|min:3|max:50',
            'cidade_id' => 'required|exists:cidade,id'
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O número mínimo de carateres é :min é obrigatório',
            'max' => 'O número máximo de carateres é :max é obrigatório',
            'exists' => 'A cidade informada não existe'
        ];
    }
}
