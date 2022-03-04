<?php

namespace App\Listeners;

use App\Notifications\WelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmailNotificationToRegisteredUser
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
     * Handle the event
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     *
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->notify(new WelcomeEmail($event->user));
    }
}
