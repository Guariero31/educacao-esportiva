<?php

namespace App\Policies;

use App\Models\Atividade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AtividadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Atividades - Listar');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Atividade $atividade)
    {
        return $user->hasPermissionTo('Atividades - Visualizar');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Atividades - Criar');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Atividade $atividade)
    {
        return $user->hasPermissionTo('Atividades - Editar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Atividade $atividade)
    {
        return $user->hasPermissionTo('Atividades - Excluir');
    }

    
}
