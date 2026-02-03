<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurmaAluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'turma_id',
    ];

    // Definindo as relações com os modelos Aluno e Turma
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}
