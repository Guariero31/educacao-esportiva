<?php

namespace App\Policies;

use App\Models\Escola;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EscolaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Escola - Listar');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Escola $escola)
    {
        return $user->hasPermissionTo('Escola - Visualizar');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Escola - Criar');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Escola $escola)
    {
        return $user->hasPermissionTo('Escola - Editar');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Escola $escola)
    {
        return $user->hasPermissionTo('Escola - Excluir');
    }

}