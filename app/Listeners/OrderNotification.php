<?php
namespace App\Listeners;

use App\Events\ProductOrdered;
use App\Mail\ProductOrderShipped;
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
        Mail::to($event->order->createdBy->email)
            ->send(new ProductOrderShipped($event->order))
        ;
    }
}
