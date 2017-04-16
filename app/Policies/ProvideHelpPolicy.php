<?php

namespace App\Policies;

use App\User;
use App\PH;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvideHelpPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pH.
     *
     * @param  \App\User  $user
     * @param  \App\ProvideHelp  $pH
     * @return mixed
     */
    public function view(User $user, PH $pH)
    {
    }

    /**
     * Determine whether the user can create pHs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $conds = $errors = [];
        // $conds[] =  $user->status == 1 ?true:false;
        // $conds[] = $user->phs()->where('provide_helps.status','<',3)->count() < \App\Config::find('ph_max')->value;
        // $answer = true;
        // foreach ($conds as $value) {
        //     $answer &= $value;
        // }
        if(!$user->primaryPhone()->count()) $errors[] = 'You need to specify a phone number in your Profile page';
        if(!$user->bankAccounts()->count()) $errors[] = 'You need to specify a bank account first';
        if(!$user->status == 1)             $errors[] = 'Your account haas been deactivated';
        $answer = [
            'status' => !count($errors),
            'messages' => $errors,
        ];
        return  $answer;
    }

    /**
     * Determine whether the user can update the pH.
     *
     * @param  \App\User  $user
     * @param  \App\ProvideHelp  $pH
     * @return mixed
     */
    public function update(User $user, ProvideHelp $pH)
    {
        //
    }

    /**
     * Determine whether the user can delete the pH.
     *
     * @param  \App\User  $user
     * @param  \App\ProvideHelp  $pH
     * @return mixed
     */
    public function delete(User $user, PH $pH)
    {
        //
    }
}
