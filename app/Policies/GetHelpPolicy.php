<?php

namespace App\Policies;

use App\User;
use App\GH;
use Illuminate\Auth\Access\HandlesAuthorization;

class GetHelpPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the gH.
     *
     * @param  \App\User  $user
     * @param  \App\GH  $gH
     * @return mixed
     */
    public function view(User $user, GH $gH)
    {
        //
    }

    /**
     * Determine whether the user can create gHs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !$user->outstandingPh()->count() && $user->phs()->count() && !$user->isBlocked();
    }

    /**
     * Determine whether the user can update the gH.
     *
     * @param  \App\User  $user
     * @param  \App\GH  $gH
     * @return mixed
     */
    public function update(User $user, GH $gH)
    {
        //
    }

    /**
     * Determine whether the user can delete the gH.
     *
     * @param  \App\User  $user
     * @param  \App\GH  $gH
     * @return mixed
     */
    public function delete(User $user, GH $gH)
    {
        //
    }
}
