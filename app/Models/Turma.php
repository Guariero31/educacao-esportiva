<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = ['nome','capacidade', 'escola_atividade_id'];

    public function programacoes()
    {
        return $this->hasMany(Programacao::class);
    }

    public function EscolaAtividade()
    {
        return $this->belongsTo(EscolaAtividade::class,'escola_atividade_id');
    }

    public function escola()
    {
        return $this->hasOneThrough(Escola::class, EscolaAtividade::class, 'id', 'id', 'escola_atividade_id', 'escola_id');
    }

    public function atividade()
    {
        return $this->hasOneThrough(Atividade::class, EscolaAtividade::class, 'id', 'id', 'escola_atividade_id', 'atividade_id');
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'turma_alunos', 'turma_id', 'aluno_id');
    }
}
