<?php

namespace App\Listeners;

use App\Events\AdminInformed;
use App\Mail\NewUser;
use Illuminate\Support\Facades\Mail;

class UserRegistered
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
     * @param  AdminInformed  $event
     * @return void
     */
    public function handle(AdminInformed $event)
    {
        foreach ($event->admins as $admin) {
            Mail::to($admin)->queue(
                new NewUser($admin, $event->user)
            );
        }
    }
}
