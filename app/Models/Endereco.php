<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'id', 'usuario_id', 'nome', 'endereco', 'lat', 'long',
    ];
}
