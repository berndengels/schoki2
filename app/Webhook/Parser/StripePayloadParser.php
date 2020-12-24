<?php
namespace App\Webhook\Parser;

use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;

class StripePayloadParser
{
    protected static $provider = 'stripe';

    static function checkoutSessionCompleted(array $payload)
    {
        $paymentId      = $payload['id'];
        $created        = $payload['created'];
        $object         = $payload['data']['object'];

        $metadata       = $object['metadata'];
        $amountTotal    = (isset($object['amount_total']) && (int) $object['amount_total'] > 0) ? (int) $object['amount_total'] / 100 : null;
        $customer       = null;

        if(isset($object['customer'])) {
            $customerID     = $object['customer'];
            $customer       = Customer::whereStripeId($customerID)->first();
        }

        $paid           = $object['payment_status'];
        $orderId        = isset($metadata['order_id']) ? (int) $metadata['order_id'] : null;

        $order = null;
        if($orderId) {
            $order = Order::find($orderId);
        }

        $params = [
            'paid_on'           => $paid ? Carbon::createFromTimestamp($created) : null,
            'amount_received'   => $amountTotal,
            'payment_id'        => $paymentId,
            'payment_provider'  => self::$provider,
        ];

        return [$order, $customer, $params];
    }

    static function invoiceCreated(array $payload)
    {
        return $payload['data']['object'];
    }
}
