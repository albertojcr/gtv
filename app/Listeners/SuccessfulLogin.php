<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;

class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     * @throws \Exception
     */
    public function handle(Login $event)
    {
       User::registerLastLogin($event);

    }
}
