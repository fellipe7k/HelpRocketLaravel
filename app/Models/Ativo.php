<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria',
        'marca',
        'modelo',
        'numero_serie',
        'descricao',
        'quantidade',
    ];
}
