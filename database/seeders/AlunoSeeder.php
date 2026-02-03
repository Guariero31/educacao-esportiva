<?php


namespace Database\Seeders;

use App\Enums\InscricaoStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\StatusEscola;
use App\Models\Aluno;
use App\Models\Escola;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aluno = Aluno::create([
            'numero_matricula' => Str::random(10),
            'nome' => 'João Silva',
            'cpf' => '123.456.789-00',
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
        
        $aluno->escolas()->sync(Escola::pluck('id')->toArray());

    }
}

