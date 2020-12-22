<?php
namespace App\Jobs\PayPalWebhooks;

use App\Events\PaymentSucceeded;
use App\Models\Customer;
use Carbon\Carbon;
use Exception;
use Spatie\WebhookClient\ProcessWebhookJob as SpatieProcessWebhookJob;
use function PHPUnit\Framework\throwException;

class HandleCheckoutOrderSuccess extends SpatieProcessWebhookJob
{
    protected $provider = 'paypal';

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        try {
            $data           = json_decode($this->webhookCall, true);
            $payload        = $data['payload'];
            $paymentId      = $payload['id'];
            $created        = $payload['create_time'];
            $eventType      = $payload['event_type'];

            if ('CHECKOUT.ORDER.COMPLETED' === $eventType) {

                $resource       = $payload['resource'];
                $purchaseUnits  = $resource['purchase_units'][0];
                $payee          = $purchaseUnits['payee'];
                $payeeEmail     = $payee['email_address'];
                $orderId        = isset($payload['reference_id']) ? $payload['reference_id'] : null;
                $amountTotal    = $purchaseUnits['amount']['value'];
                $customer       = null;

                if($payeeEmail) {
                    $customer = Customer::whereEmail($payeeEmail)->first();
                }

                $params = [
                    'paid_on'           => Carbon::make($created)->format('Y-m-d H:i:s'),
                    'amount_received'   => $amountTotal,
                    'payment_id'        => $paymentId,
                    'payment_provider'  => $this->provider,
                ];

                if($orderId && $customer) {
                    event(new PaymentSucceeded($this->provider, $params, $orderId, $customer));
                }
            }

            http_response_code(200); //Acknowledge you received the response
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
