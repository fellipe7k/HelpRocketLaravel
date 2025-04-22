<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chamado extends Model
{
    use HasFactory;

    /**
     * A tabela associada com o modelo.
     *
     * @var string
     */
    protected $table = 'chamados';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'prioridade',
        'categoria',
        'departamento',
        'localizacao',
        'usuario_id',
        'atendente_id',
        'data_abertura',
        'data_fechamento',
        'data_limite',
        'is_draft',
        'notificar_email',
    ];

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_abertura' => 'datetime',
        'data_fechamento' => 'datetime',
        'data_limite' => 'date',
        'is_draft' => 'boolean',
        'notificar_email' => 'boolean',
    ];

    /**
     * Obter o usuário que abriu o chamado.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Obter o atendente responsável pelo chamado.
     */
    public function atendente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'atendente_id');
    }

    /**
     * Obter os anexos do chamado.
     */
    public function anexos(): HasMany
    {
        return $this->hasMany(ChamadoAnexo::class);
    }
}