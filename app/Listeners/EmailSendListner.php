<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\RegisterEmailSendEvent;
use App\Mail\RegistrationMail;

class EmailSendListner
{
    use InteractsWithQueue;

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
    public function handle(RegisterEmailSendEvent $event): void
    {
        /** Sending Email */
        Mail::to($event->email)->send(new RegistrationMail($event->email));
        Log::info("Email Send From Listner", ['email' => $event->email]);
    }
}