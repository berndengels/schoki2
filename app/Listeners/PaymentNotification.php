<?php
namespace App\Listeners;

use App\Mail\OrderPayed;
use App\Events\PaymentSucceeded;
use App\Models\AdminUser;
use Exception;
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
            $to = AdminUser::role('Shop')->pluck('email')->toArray();
            try {
                Mail::to($to)
                    ->later(now()->addSeconds(30), new OrderPayed($event->provider, $event->customer, $event->order, $event->params))
                ;
                $event->order->update(['mail_to_shop' => now()] );
            } catch(Exception $e) {
                throw new Exception($e);
            }
        }
    }
}
