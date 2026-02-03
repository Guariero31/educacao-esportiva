<?php

namespace App\Models;

use App\Enums\Periodo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
        'nome',
        'periodo',
        'vagas',
    ];

    protected $casts = [
        'periodo' => 'array',
    ];

    public function escolas()
    {
        return $this->belongsToMany(Escola::class, 'escola_atividades', 'escola_id', 'atividade_id');
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class);
    }
}
