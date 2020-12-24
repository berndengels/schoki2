<?php
namespace App\Listeners;

use App\Mail\OrderShipped;
use App\Events\ProductOrdered;
use Illuminate\Support\Facades\Mail;

class OrderNotification
{
    /**
     * Handle the event.
     *
     * @param  ProductOrdered  $event
     * @return void
     */
    public function handle(ProductOrdered $event )
    {
        // @TODO: email notification for customer and shop owner
        Mail::to($event->invoice->customer_email)
            ->send(new OrderShipped($event->invoice))
        ;
    }
}
