<?php

namespace App\Policies;

use App\User;
use App\ProvideHelp;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvideHelpPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ProvideHelp.
     *
     * @param  \App\User  $user
     * @param  \App\ProvideHelp  $ph
     * @return mixed
     */
    public function view(User $user, ProvideHelp $ph)
    {
        return true;
    }

    /**
     * Determine whether the user can create pHs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the ProvideHelp.
     *
     * @param  \App\User  $user
     * @param  \App\ProvideHelp  $ph
     * @return mixed
     */
    public function update(User $user, ProvideHelp $ph)
    {
        //
    }

    /**
     * Determine whether the user can delete the ProvideHelp.
     *
     * @param  \App\User  $user
     * @param  \App\ProvideHelp  $ph
     * @return mixed
     */
    public function delete(User $user, ProvideHelp $ph)
    {
        return $ph->status == 1 && $ph->authOwner();
    }
}
