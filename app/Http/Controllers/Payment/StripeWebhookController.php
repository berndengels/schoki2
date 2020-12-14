<?php
namespace App\Http\Controllers\Payment;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return Response
     */
    public function paymentSuccess($payload)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function paymentFailed($payload)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function paymentCompleted($payload)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function all($payload)
    {
        // Handle the incoming event...
        dd($payload);
    }
}
