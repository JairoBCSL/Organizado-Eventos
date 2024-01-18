<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $table = 'cidade';

    public function locais(){
        return $this->hasMany('\App\Models\Local');
    }

    public function rules(){
        return [
            'nome' => 'required|min:3|max:50',
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O número mínimo de carateres é :min é obrigatório',
            'max' => 'O número máximo de carateres é :max é obrigatório'
        ];
    }


}
