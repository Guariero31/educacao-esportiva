<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracao;

class ConfiguracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracao::updateOrCreate(
            ['id' => 1], 
            ['limite_atividades_aluno' => 10]
        );
    }
}
