<?php
namespace App\Listeners;

use App\Mail\OrderPayed;
use App\Events\PaymentSucceeded;
use Illuminate\Support\Facades\Mail;

class PaymentNotification
{
    /**
     * Handle the event.
     *
     * @param  PaymentSucceeded  $event
     * @return void
     */
    public function handle(PaymentSucceeded $event)
    {
        // @TODO: email notification for admin user, who handles payment stuff
        Mail::to(env('LOGGER_EMAIL'))
            ->send(new OrderPayed($event))
        ;
    }
}