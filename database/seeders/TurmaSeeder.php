<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turma;
use App\Models\Programacao;

class TurmaSeeder extends Seeder
{
    public function run()
    {
//        $turmas = [
//            [
//                'nome' => 'Turma Infantil',
//                'escola_id' => 1,
//                'programacoes' => [
//                    [
//                        'dia_semana' => 'segunda',
//                        'inicio' => '08:00:00',
//                        'fim' => '10:00:00',
//                        'local' => 'Quadra 1',
//                    ],
//                    [
//                        'dia_semana' => 'quarta',
//                        'inicio' => '08:00:00',
//                        'fim' => '10:00:00',
//                        'local' => 'Quadra 1',
//                    ],
//                ],
//            ],
//            [
//                'nome' => 'Turma Infanto',
//                'escola_id' => 1,
//                'programacoes' => [
//                    [
//                        'dia_semana' => 'terça',
//                        'inicio' => '10:00:00',
//                        'fim' => '12:00:00',
//                        'local' => 'Quadra 2',
//                    ],
//                    [
//                        'dia_semana' => 'quinta',
//                        'inicio' => '10:00:00',
//                        'fim' => '12:00:00',
//                        'local' => 'Quadra 2',
//                    ],
//                ],
//            ],
//            [
//                'nome' => 'Turma Juvenil',
//                'escola_id' => 1,
//                'programacoes' => [
//                    [
//                        'dia_semana' => 'sexta',
//                        'inicio' => '14:00:00',
//                        'fim' => '16:00:00',
//                        'local' => 'Quadra 3',
//                    ],
//                    [
//                        'dia_semana' => 'sábado',
//                        'inicio' => '14:00:00',
//                        'fim' => '16:00:00',
//                        'local' => 'Quadra 3',
//                    ],
//                ],
//            ],
//        ];
//
//        foreach ($turmas as $turmaData) {
//            $programacoes = $turmaData['programacoes'];
//            unset($turmaData['programacoes']);
//
//            $turma = Turma::create($turmaData);
//
//            foreach ($programacoes as $programacaoData) {
//                $turma->programacoes()->create($programacaoData);
//            }
//        }
    }
}
