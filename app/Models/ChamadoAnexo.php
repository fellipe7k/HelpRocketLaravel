<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChamadoAnexo extends Model
{
    use HasFactory;

    /**
     * A tabela associada com o modelo.
     *
     * @var string
     */
    protected $table = 'chamado_anexos';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chamado_id',
        'nome_arquivo',
        'caminho_arquivo',
        'tipo_arquivo',
        'tamanho_arquivo',
    ];

    /**
     * Obter o chamado ao qual este anexo pertence.
     */
    public function chamado(): BelongsTo
    {
        return $this->belongsTo(Chamado::class);
    }
}