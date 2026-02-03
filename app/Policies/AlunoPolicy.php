<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Aluno;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlunoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Alunos - Listar');
    }

    public function view(User $user, Aluno $aluno)
    {
        return $user->hasPermissionTo('Alunos - Visualizar');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Alunos - Criar');
    }

    public function update(User $user, Aluno $aluno)
    {
        return false;
        //return $user->hasPermissionTo('Alunos - Editar');
    }

    public function delete(User $user, Aluno $aluno)
    {
        return $user->hasPermissionTo('Alunos - Excluir');
    }
}
