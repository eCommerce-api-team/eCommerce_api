<?php

namespace App\Listeners;

use App\Mail\WelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailListener implements ShouldQueue
{
    public function handle(Registered $event): void
    {
        $user = $event->user;

        Mail::to($user->email)->queue(new WelcomeEmail($user));
    }
}
