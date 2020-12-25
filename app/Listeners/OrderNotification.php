<?php
namespace App\Listeners;

use App\Models\Customer;
use App\Models\Download;
use App\Mail\OrderShipped;
use App\Events\ProductOrdered;
use Illuminate\Support\Facades\Hash;

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
        $token      = Hash::make(json_encode($event->invoice));
        $params     = [
            'token' => $token,
            'route' => route('payment.invoice.download', compact('token')),
            'valid_until'   => null,
        ];
        $download   = Download::updateOrCreate($params);
        $download->customer()->associate($customer);

        // @TODO: email notification for customer and shop owner
        Mail::to($email)
            ->send(new OrderShipped($event->invoice, $token))
        ;
    }
}
