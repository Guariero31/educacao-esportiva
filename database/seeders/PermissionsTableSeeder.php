<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $role = Role::create(['name'=>'super-admin','guard_name'=>'web']);
        $permissions = [
           
            ['name' => 'Usuários', 'title' => 'Usuários', 'order' => 1],
            ['name' => 'Alunos', 'title' => 'Alunos', 'order' => 2],
            ['name' => 'Ano Bases', 'title' => 'Ano Bases', 'order' => 3],
            ['name' => 'Atividades', 'title' => 'Atividades', 'order' => 4],
            ['name' => 'Escola', 'title' => 'Escola', 'order' => 5],
            ['name' => 'Matrículas', 'title' => 'Matrículas', 'order' => 6],
            ['name' => 'Permissões', 'title' => 'Permissões', 'order' => 7],
            ['name' => 'Configurações', 'title' => 'Configurações', 'order' => 8],
            ['name' => 'Responsáveis', 'title' => 'Responsáveis', 'order' => 9],
            
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission['name'].' - Listar','guard_name'=>'web', 'title' => $permission['title'], 'order' => $permission['order']]);
            Permission::create(['name'=>$permission['name'].' - Criar','guard_name'=>'web', 'title' => $permission['title'], 'order' => $permission['order']]);
            Permission::create(['name'=>$permission['name'].' - Editar','guard_name'=>'web', 'title' => $permission['title'], 'order' => $permission['order']]);
            Permission::create(['name'=>$permission['name'].' - Visualizar','guard_name'=>'web', 'title' => $permission['title'], 'order' => $permission['order']]);
            Permission::create(['name'=>$permission['name'].' - Excluir','guard_name'=>'web', 'title' => $permission['title'], 'order' => $permission['order']]);
        }


        $permissions = Permission::all();
        $role->permissions()->sync($permissions);

        $users = User::get();
        foreach($users as $user){
            $user->assignRole($role->name);
        }
    }
}
