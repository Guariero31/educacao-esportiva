<?php

namespace App\Policies;

use App\Models\Responsavel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResponsavelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Responsáveis - Listar');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Responsavel $responsavel)
    {
        return $user->hasPermissionTo('Responsáveis - Visualizar');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Responsáveis - Criar');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Responsavel $responsavel)
    {
        return $user->hasPermissionTo('Responsáveis - Editar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Responsavel $responsavel)
    {
        return $user->hasPermissionTo('Responsáveis - Excluir');
    }
}
