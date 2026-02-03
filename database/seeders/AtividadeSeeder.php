<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atividade;
use App\Enums\Periodo;

class AtividadeSeeder extends Seeder
{
    public function run()
    {
        $atividades = [
            [
                'nome' => 'Futebol',
                'periodo' => Periodo::Manha,
                'vagas' => 20,
            ],
            [
                'nome' => 'Basquete',
                'periodo' => Periodo::Tarde,
                'vagas' => 15,
            ],
            [
                'nome' => 'Vôlei',
                'periodo' => Periodo::Noite,
                'vagas' => 18,
            ],
            [
                'nome' => 'Tênis de Mesa',
                'periodo' => Periodo::Tarde,
                'vagas' => 10,
            ],
        ];

        foreach ($atividades as $atividade) {
            Atividade::create($atividade);
        }
    }
}
