<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle to the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //email de boas vindas ao usuário
        //UserEmailJob::dispatch($user,'user-created-welcome',$pass)->onQueue('emails');
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }
}
