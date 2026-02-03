<?php

namespace Database\Seeders;

use App\Models\Escola;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'evandro@acto.com.br'],
            [
                'name' => 'Evandro',
                'password' => Hash::make('123'),
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'manu.oficial93@gmail.com'],
            [
                'name' => 'Emanuel',
                'password' => Hash::make('123'),
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'ghinozzi@gmail.com'],
            [
                'name' => 'teste',
                'password' => Hash::make('123'),
            ]
        );
        $this->call([
            PermissionsTableSeeder::class,
            EscolasSeeder::class,
            AtividadeSeeder::class,
            AlunoSeeder::class,
            ConfiguracaoSeeder::class,
            TurmaSeeder::class,

        ]);
    }
}
