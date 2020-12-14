<?php
namespace App\Http\Controllers\Payment;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return Response
     */
    public function handleWebhook($payload = null)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function handleAsyncPaymentSucceeded($payload = null)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function handleAsyncPaymentFailed($payload = null)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function handleCompleted($payload = null)
    {
        // Handle the incoming event...
        dd($payload);
    }

    public function handleAll($payload = null)
    {
        // Handle the incoming event...
        dd($payload);
    }
}
