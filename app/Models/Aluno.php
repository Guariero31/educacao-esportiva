<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\InscricaoStatus;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos'; // Nome da tabela correspondente

    protected $fillable = [
        'nome',
        'numero_matricula',
        'cpf',
        'escola_codigo',
        'escola_nome',
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'complemento',
        'latitude',
        'longitude',
        'sexo',
        'nascimento',
        'rg',
        'rg_data_expedicao',
        'rg_orgao_expedicao',
        'certidao_nascimento_numero',
        'certidao_nascimento_livro',
        'certidao_nascimento_folha',
        'email',
        'status_aluno_id',
        'user_id',
        'pne',
        'cor_id',
        'numero_nis',
        'diabetico',
        'deficiente',
        'deficiencia_id',
        'sus',
        'nome_social',
        'email_google',
        'telefone',
        'celular',
        'tipo_sanguineo',
        'codigo_inep',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'nascimento' => 'date',
        'pne' => 'boolean',
        'diabetico' => 'boolean',
        'deficiente' => 'boolean',
        'status' => InscricaoStatus::class,
    ];

    public function responsaveis()
    {
        return $this->belongsToMany(Responsavel::class, 'aluno_responsavel', 'aluno_id', 'responsavel_id');
    }

    public function escolas()
    {
        return $this->belongsToMany(Escola::class, 'aluno_escolas');
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turma_alunos', 'aluno_id', 'turma_id')
            ->with('atividade', 'programacoes', 'escola');
    }

    public function matricula()
    {
        return $this->hasMany(Matricula::class);
    }

}
