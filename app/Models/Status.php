<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $table = 'status';

    public function pagamentos(){
        return $this->hasMany('\App\Models\Pagamento');
    }
}
