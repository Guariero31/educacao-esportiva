<?php

namespace App\Policies;

use App\Models\Matricula;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatriculaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Matrículas - Listar');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Matricula $matricula)
    {
        return $user->hasPermissionTo('Matrículas - Visualizar');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Matrículas - Criar');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Matricula $matricula)
    {
        return $user->hasPermissionTo('Matrículas - Editar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Matricula $matricula)
    {
        return $user->hasPermissionTo('Matrículas - Excluir');
    }
}
