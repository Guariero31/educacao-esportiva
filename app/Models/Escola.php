<?php

namespace App\Models;

use App\Enums\StatusEscola;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model implements HasName
{
    use HasFactory;
    protected $table = 'escolas'; // Nome da tabela correspondente

    protected $fillable = [
        'nome',
        'status',
        'ano'
    ];

    protected $casts = [
        'status' => StatusEscola::class,
    ];

    public function getFilamentName(): string
    {
        return $this->nome;
    }

    public function atividades()
    {
        return $this->belongsToMany(Atividade::class, 'escola_atividades', 'escola_id', 'atividade_id');
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_escolas');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_escolas');
    }

    public function responsavels()
    {
        return $this->belongsToMany(Responsavel::class, 'responsavel_escola', 'escola_id', 'responsavel_id');
    }

    public function matricula()
    {
        return $this->hasMany(Matricula::class);
    }

    public function turmas()
    {
        return $this->hasManyThrough(
            Turma::class,
            EscolaAtividade::class,
            'escola_id',
            'escola_atividade_id',
            'id',
            'id'
        );
    }
}
