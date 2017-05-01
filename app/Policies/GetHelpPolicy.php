<?php

namespace App\Policies;

use App\User;
use App\GetHelp;
use Illuminate\Auth\Access\HandlesAuthorization;

class GetHelpPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the GetHelp.
     *
     * @param  \App\User  $user
     * @param  \App\GetHelp  $gh
     * @return mixed
     */
    public function view(User $user, GetHelp $gh)
    {
        return true;   //
    }

    /**
     * Determine whether the user can create GetHelps.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $errors = [];
        return !$user->outstandingPh()->count() && $user->phs()->count() && !$user->isBlocked();
    }

    /**
     * Determine whether the user can update the GetHelp.
     *
     * @param  \App\User  $user
     * @param  \App\GetHelp  $gh
     * @return mixed
     */
    public function update(User $user, GetHelp $gh)
    {
        //
    }

    /**
     * Determine whether the user can delete the GetHelp.
     *
     * @param  \App\User  $user
     * @param  \App\GetHelp  $gh
     * @return mixed
     */
    public function delete(User $user, GetHelp $gh)
    {
        return $gh->status === 1 && $gh->authOwner();
        // return true;
    }
}
