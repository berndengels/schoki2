<?php
namespace App\Jobs\StripeWebhooks;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use App\Events\PaymentSucceeded;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
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
    public static $count = 0;

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

            $params = [
                'paid_on'           => $paid ? Carbon::createFromTimestamp($created) : null,
                'amount_received'   => $amountTotal,
                'payment_id'        => $paymentId,
                'payment_provider'  => 'stripe',
            ];
//            Log::info($payload['type'], ['count' => static::$count++]);
            // @todo: queue stuff
            event(new PaymentSucceeded($params, $orderId, $customer));
        }
    }
}
