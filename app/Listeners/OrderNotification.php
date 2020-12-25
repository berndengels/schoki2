<?php
namespace App\Listeners;

use Exception;
use App\Models\Customer;
use App\Models\Download;
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
        $email      = $event->invoice->customer_email;
        $customer   = Customer::whereEmail($email)->first();
        $token      = hash_hmac('sha256',json_encode($event->invoice), $customer->password);
        $params     = [
            'token'         => $token,
            'object_id'     => $event->invoice->id,
            'customer_id'   => $customer->id,
            'valid_until'   => null,
        ];
        try {
            Download::updateOrCreate($params);
        } catch(Exception $e) {
            die($e->getMessage());
        }
        Mail::to($email)
            ->queue(new OrderShipped($event->invoice, $token))
        ;
    }
}
