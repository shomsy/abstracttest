<?php

namespace App\Listeners;

use App\Events\CheckIdentity;
use App\Models\User;
use App\Notifications\ConfirmIdentityEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConfirmIdentityEmailNotification
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
     * @param  \App\Events\CheckIdentity  $event
     *
     * @return void
     */
    public function handle(CheckIdentity $event)
    {
        $event->user->notify(new ConfirmIdentityEmail($event->user, $event->userIp, $event->location));
    }
}
