<?php

namespace App\Listeners;

use App\Events\CreatedAdminUserEvent;
use App\Mail\SendPasswordToAdminUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailWithPasswordToAdminUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreatedAdminUserEvent $event): void
    {
        //

        Mail::to($event->user->email)->send(new SendPasswordToAdminUserMail($event->user,$event->passwordTextPlain));
    }
}
