<?php
namespace App\Jobs\StripeWebhooks;

use App\Events\PaymentSucceeded;
use App\Mail\Logger;
use App\Models\Customer;
use App\Repositories\ShopRepository;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Models\WebhookCall;


class HandlePaymentIntentSucceeded implements ShouldQueue
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
        Mail::to(env('LOGGER_EMAIL'))->send(new Logger(__METHOD__. ': i am outside'));
        $payload = $this->webhookCall->payload;
        $paymentId = $payload['id'];
        if('payment_intent.succeeded' === $payload['type']) {
            $created = $payload['created'];
            $object = $payload['data']['object'];
            $amountReceived = ($object['amount_received'] > 0) ? $object['amount_received'] / 100 : null;
            $customerID = $object['customer'];
            if('succeeded' === $object['status']) {
                $chargesData   = $object['charges']['data'][0];
                $paid          = (bool) $chargesData['paid'];
                $customerName  = $chargesData['billing_details']['name'];
                $customer      = Customer::whereStripeId($customerID)->first();
                if($customer) {
                    Mail::to(env('LOGGER_EMAIL'))->send(new Logger(__METHOD__. ': Order created for: '.$customerName));
                    event(new PaymentSucceeded($customer, $amountReceived, $created, $paid, $paymentId, 'stripe'));
                } else {
                    Mail::to(env('LOGGER_EMAIL'))->send(new Logger(__METHOD__. ': can not find customer by stripeID: '.$customerID));
                }
            }
        }
    }
}
