<?php
namespace App\Jobs\StripeWebhooks;

use App\Models\Webhook;
use Illuminate\Bus\Queueable;
use App\Events\ProductOrdered;
use App\Events\PaymentSucceeded;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Webhook\Parser\StripePayloadParser;
use Illuminate\Foundation\Bus\Dispatchable;

class HandleSessionCheckout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $provider = 'stripe';
    protected $events = [
        'invoice.created',
        'checkout.session.completed',
    ];

    /**
     * @var Webhook
     */
    public $webhook;

    public function __construct(Webhook $webhook)
    {
        $this->webhook = $webhook;
    }

    public function handle()
    {
        // do your work here
        // you can access the payload of the webhook call with `$this->webhookCall->payload`
        $payload        = $this->webhook->payload;
        $eventType      = $payload['type'];

        if (in_array($eventType, $this->events)) {
            switch ($eventType) {
                case 'invoice.created':
                    $invoice = StripePayloadParser::invoiceCreated($payload);
                    if($invoice) {
                        event(new ProductOrdered($invoice));
                        http_response_code(200); //Acknowledge you received the response
                    }
                    break;
                case 'checkout.session.completed':
                    list($order, $customer, $params) = StripePayloadParser::checkoutSessionCompleted($payload);
                    if($order && $customer) {
                        event(new PaymentSucceeded($this->provider, $customer, $order, $params));
                        http_response_code(200); //Acknowledge you received the response
                    }
                    break;
                default:
                    http_response_code(503); //Acknowledge you received the response
                    break;
            }
            http_response_code(503); //Acknowledge you received the response
        }
    }
}
