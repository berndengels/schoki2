<?php
namespace App\Jobs\StripeWebhooks;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use App\Events\PaymentSucceeded;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;


class HandleSessionCheckoutCompleted implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $provider = 'stripe';
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
            $customer       = null;

            if(isset($object['customer'])) {
                $customerID     = $object['customer'];
                $customer       = Customer::whereStripeId($customerID)->first();
            }

            $paid           = $object['payment_status'];
            $orderId        = isset($metadata['order_id']) ? (int) $metadata['order_id'] : null;

            $params = [
                'paid_on'           => $paid ? Carbon::createFromTimestamp($created) : null,
                'amount_received'   => $amountTotal,
                'payment_id'        => $paymentId,
                'payment_provider'  => $this->provider,
            ];
            // @todo: queue stuff
            if($orderId && $customer) {
                event(new PaymentSucceeded($this->provider, $params, $orderId, $customer));
            }
            http_response_code(200); //Acknowledge you received the response
        }
    }
}
