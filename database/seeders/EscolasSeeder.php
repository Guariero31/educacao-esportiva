<?php

namespace Database\Seeders;

use App\Enums\StatusEscola;
use App\Models\Escola;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscolasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Escola::query()->create([
            'nome' => 'Escola 1',
            'status' => StatusEscola::ATIVA->value,
            'ano' => 2024
        ]);

        Escola::query()->create([
            'nome' => 'Escola 2',
            'status' => StatusEscola::ATIVA->value,
            'ano' => 2024
        ]);

        $users = User::get();

        foreach($users as $user){
            $user->escolas()->sync(Escola::pluck('id')->toArray());
        }
    }
}
