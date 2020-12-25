<?php
namespace App\Jobs\PayPalWebhooks;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Webhook;
use App\Models\Customer;
use App\Events\PaymentSucceeded;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleCheckoutOrder
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $provider = 'paypal';
    protected $events = [
        'CHECKOUT.ORDER.COMPLETED',
        'CHECKOUT.ORDER.APPROVED',
    ];

    /**
     * @var Webhook
     */
    public $webhook;

    public function __construct(Webhook $webhook)
    {
        $this->webhook = $webhook;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        try {
            $payload        = $this->webhook->payload;
            $paymentId      = $payload['id'];
            $created        = $payload['create_time'];
            $eventType      = $payload['event_type'];

            if (in_array($eventType, $this->events)) {
                $resource       = $payload['resource'];
                $payer          = isset($resource['payer']) ? $resource['payer'] : null;
                $purchaseUnits  = $resource['purchase_units'][0];
                $orderId        = isset($payload['reference_id']) ? $payload['reference_id'] : null;
                $amountTotal    = $purchaseUnits['amount']['value'];
                $customer       = null;

                if($payer) {
                    $email = $payer['email_address'];
                    $customer = Customer::whereEmail($email)->first();
                }

                $order = null;
                if($orderId) {
                    $order = Order::find($orderId);
                }

                $params = [
                    'paid_on'           => Carbon::make($created)->format('Y-m-d H:i:s'),
                    'amount_received'   => $amountTotal,
                    'payment_id'        => $paymentId,
                    'payment_provider'  => $this->provider,
                ];

                if($order && $customer) {
                    event(new PaymentSucceeded($this->provider, $customer, $order, $params));
                }
            }

            http_response_code(200); //Acknowledge you received the response
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
