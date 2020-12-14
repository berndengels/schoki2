<?php
namespace App\Jobs\StripeWebhooks;

use App\Models\Customer;
use App\Repositories\ShopRepository;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
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

    public function handle(Cart $cart)
    {
        // do your work here
        // you can access the payload of the webhook call with `$this->webhookCall->payload`
        $payload = $this->webhookCall->payload;
        if('payment_intent.succeeded' === $payload['type']) {
            $created = $payload['created'];
            $object = $payload['data']['object'];
            $amountReceived = ($object['amount_received'] > 0) ? $object['amount_received'] / 100 : null;
            $customerID = $object['customer'];
            if('succeeded' === $object['status']) {
                $chargesData = $object['charges']['data'][0];
                 if('succeeded' === $chargesData['status'] && true === (bool) $chargesData['paid']) {
                     $customerName  = $chargesData['billing_details']['name'];
                     $customerEmail = $chargesData['billing_details']['email'];
                     /**
                      * @todo handle successful payment
                      * @todo set order, order_items by cartItems
                      * @todo set order: created_by (customer), created_at, price_total, paid_on
                      */
                     $customer = Customer::whereStripeId($customerID)->first();
                     $order = ShopRepository::createOrder($customer, $cart, $amountReceived, true);
                     Log::info(__FUNCTION__ . ' Order created');
//                     $cart->destroy();
                 }
            }

        }
    }
}
