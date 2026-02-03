<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $table = 'responsaveis';

    protected $fillable = [
        'nome',
        'rg',
        'rg_data_emissao',
        'rg_orgao_emissor',
        'rg_uf',
        'cpf',
        'parentesco',
        'celular',
        'email',
        'responsavel_legal'
    ];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_responsavel', 'aluno_id', 'responsavel_id');
    }

    public function escolas()
    {
        return $this->belongsToMany(Escola::class, 'responsavel_escola', 'responsavel_id', 'escola_id');
    }
}
