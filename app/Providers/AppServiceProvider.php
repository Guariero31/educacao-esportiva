<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Aluno;
use App\Policies\AlunoPolicy;
use App\Policies\AlunoResponsavelPolicy;
use App\Models\AlunoResponsavel;
use App\Models\Atividade;
use App\Policies\AtividadePolicy;
use App\Models\Escola;
use App\Policies\EscolaPolicy;
use App\Models\EscolaAtividade;
use App\Policies\EscolaAtividadePolicy;
use App\Models\Matricula;
use App\Policies\MatriculaPolicy;
use App\Models\MatriculaAtividade;
use App\Policies\MatriculaAtividadePolicy;
use App\Models\Responsavel;
use App\Policies\ResponsavelPolicy;
use App\Models\AnoBase;
use App\Policies\AnoBasePolicy;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Aluno::class => AlunoPolicy::class,
        AlunoResponsavel::class => AlunoResponsavelPolicy::class,
        Atividade::class => AtividadePolicy::class,
        Escola::class => EscolaPolicy::class,
        EscolaAtividade::class => EscolaAtividadePolicy::class,
        Matricula::class => MatriculaPolicy::class,
        MatriculaAtividade::class => MatriculaAtividadePolicy::class,
        Responsavel::class => ResponsavelPolicy::class,
        AnoBase::class => AnoBasePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
