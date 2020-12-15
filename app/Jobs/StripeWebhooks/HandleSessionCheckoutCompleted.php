<?php
namespace App\Jobs\StripeWebhooks;

use App\Events\PaymentSucceeded;
use App\Mail\Logger;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Models\WebhookCall;


class HandleSessionCheckoutCompleted implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var WebhookCall
     */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        // do your work here
        // you can access the payload of the webhook call with `$this->webhookCall->payload`
        $payload    = $this->webhookCall->payload;
        $paymentId  = $payload['id'];
        $created    = $payload['created'];

        if ('checkout.session.completed' === $payload['type']) {
            $object         = $payload['data']['object'];
            $metadata       = $object['metadata'];
            $amountTotal    = ((int) $object['amount_total'] > 0) ? (int) $object['amount_total'] / 100 : null;
            $customerID     = $object['customer'];
            $customer       = Customer::whereStripeId($customerID)->first();
            $paid           = $object['payment_status'];
            $orderId        = (int) $metadata['order_id'];

            $orderParams = [
                'paid_on'           => $paid ? Carbon::createFromTimestamp($created) : null,
                'amount_received'   => $amountTotal,
                'payment_id'        => $paymentId,
                'payment_type'      => 'stripe',
            ];

            event(new PaymentSucceeded($orderParams, $orderId, $customer));
        }
    }
}
