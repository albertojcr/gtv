<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $admins;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admins, $user)
    {
        $this->admins = $admins;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-user');
    }
}
