<?php

namespace App\Listeners;

use App\Events\UserWasRegisted;
use App\Mail\LoginCredentials;
use Illuminate\Support\Facades\Mail;

class SendLoginCredentials
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
     * @param  UserWasRegisted  $event
     * @return void
     */
    public function handle(UserWasRegisted $event)
    {
        Mail::to($event->user)->queue(
            new LoginCredentials($event->user, $event->password)
        );
    }
}
