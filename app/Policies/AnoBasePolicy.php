<?php

namespace App\Policies;

use App\Models\AnoBase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnoBasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Ano Bases - Listar');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AnoBase $anoBase)
    {
        return $user->hasPermissionTo('Ano Bases - Visualizar');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Ano Bases - Criar');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AnoBase $anoBase)
    {
        return $user->hasPermissionTo('Ano Bases - Editar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AnoBase $anoBase)
    {
        return $user->hasPermissionTo('Ano Bases - Excluir');
    }
}
