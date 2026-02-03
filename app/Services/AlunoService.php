<?php

namespace App\Services;

use App\Enums\InscricaoStatus;
use App\Enums\StatusEscola;
use App\Filament\Resources\AlunoResource;
use App\Models\Aluno;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class AlunoService
{
    static function carregaAluno($informacao, $tipo, $set)
    {
        if (!empty($informacao)) {

            $aluno = self::buscaAluno($informacao, $tipo);
            if (!empty($aluno->id)) {

                $tenant = Filament::getTenant();
                if ($aluno->escolas()->where('escolas.id', $tenant->id)->exists()) {
                    Notification::make()
                        ->title('Esse aluno já esta vinculado a sua escola')
                        ->info()
                        ->send();
                }
                $set('id', $aluno->id);
                $set('numero_matricula', $aluno->numero_matricula);
                $set('nome', $aluno->nome);
                $set('cpf', $aluno->cpf);
                $set('nascimento', $aluno->nascimento->format('Y-m-d'));
                $set('email', $aluno->email);
            }
        }
    }

    static function buscaAluno($informacao, $tipo): Aluno|null
    {
        if(strlen(removeMascaraCpf($informacao)) != 11){
           return null;
        }

        $aluno = null;
        switch ($tipo) {
            case 'matricula':
                $aluno = Aluno::query()->where('numero_matricula', $informacao)->first();
            case 'cpf':
                if (strlen(removeMascaraCpf($informacao)) == 11) {
                    $aluno = Aluno::query()->where('cpf', removeMascaraCpf($informacao))->first();
                }
            default:
                break;
        }
        if(!empty($aluno->id)){
            return $aluno;
        }else{
            return self::buscaAlunoApi($informacao, $tipo);
        }
    }

    static function buscaAlunoApi($informacao, $tipo)
    {

        if ($tipo == 'cpf') {        
            if (strlen(removeMascaraCpf($informacao)) == 11) {
                $aluno = Aluno::create([
                    'numero_matricula' => Str::random(10),
                    'nome' => 'Aluno API' . rand(1, 400),
                    'cpf' => removeMascaraCpf($informacao),
                    'escola_codigo' => 'ESC123',
                    'escola_nome' => 'Escola Exemplo',
                    'cep' => '12345-678',
                    'rua' => 'Rua Exemplo',
                    'numero' => '123',
                    'bairro' => 'Bairro Exemplo',
                    'cidade' => 'Cidade Exemplo',
                    'estado' => 'Estado Exemplo',
                    'complemento' => 'Apto 1',
                    'latitude' => '-23.550520',
                    'longitude' => '-46.633308',
                    'sexo' => 'M',
                    'nascimento' => '2000-01-01',
                    'rg' => '123456789',
                    'rg_data_expedicao' => '2015-01-01',
                    'rg_orgao_expedicao' => 'SSP',
                    'certidao_nascimento_numero' => '123456',
                    'certidao_nascimento_livro' => 'A',
                    'certidao_nascimento_folha' => '10',
                    'email' => 'joao@example.com',
                    'status_aluno_id' => 1,
                    'user_id' => 1,
                    'pne' => false,
                    'cor_id' => 1,
                    'numero_nis' => '12345678900',
                    'diabetico' => false,
                    'deficiente' => false,
                    'deficiencia_id' => null,
                    'sus' => '123456789012345',
                    'nome_social' => null,
                    'email_google' => 'joao@gmail.com',
                    'telefone' => '1234-5678',
                    'celular' => '98765-4321',
                    'tipo_sanguineo' => 'O+',
                    'codigo_inep' => '12345678',
                    'status' => InscricaoStatus::ATIVA->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return $aluno;
            }
        }
        return null;
    }
}
