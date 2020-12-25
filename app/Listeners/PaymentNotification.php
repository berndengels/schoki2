<?php
namespace App\Listeners;

use App\Mail\OrderPayed;
use App\Events\PaymentSucceeded;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Mail;

class PaymentNotification
{
    /**
     * Handle the event.
     *
     * @param  PaymentSucceeded $event
     * @return void
     */
    public function handle(PaymentSucceeded $event)
    {
        if($event->provider && $event->customer && $event->order && $event->params) {
            // @TODO: email notification for admin user, who handles payment stuff
            $to = AdminUser::role('Shop')->pluck('email')->toArray();
            Mail::to($to)
                ->queue(new OrderPayed($event->provider, $event->customer, $event->order, $event->params))
            ;
        }
    }
}
