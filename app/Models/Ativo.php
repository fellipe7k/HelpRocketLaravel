<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
