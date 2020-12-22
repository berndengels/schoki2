<?php

use App\Models\Webhook;
use App\Webhook\PayPalWebhookProfile;
use App\Webhook\StripeWebhookProfile;
use App\Webhook\MyDefaultRespondsTo;
use App\Validators\PayPalSignatureValidator;
use App\Validators\StripeSignatureValidator;
use App\Jobs\PayPalWebhooks\HandleCheckoutOrder;
use App\Jobs\StripeWebhooks\HandleSessionCheckout;

return [
    'configs' => [
        [
            'name' => 'paypal',
            'webhook_model'     => Webhook::class,
            'signing_secret'    => env('STRIPE_WEBHOOK_SECRET'),
            'signature_header_name' => 'x-paystack-signature',
            'signature_validator'   => PayPalSignatureValidator::class,
            'webhook_profile'       => PayPalWebhookProfile::class,
            'webhook_response'      => MyDefaultRespondsTo::class,
            'process_webhook_job'   => HandleCheckoutOrder::class,
        ],
        [
            'name' => 'stripe',
            'webhook_model'     => Webhook::class,
            'signing_secret'    => env('STRIPE_WEBHOOK_SECRET'),
            'signature_header_name' => 'Stripe-Signature',
            'signature_validator'   => StripeSignatureValidator::class,
            'webhook_profile'       => StripeWebhookProfile::class,
            'webhook_response'      => MyDefaultRespondsTo::class,
            'process_webhook_job'   => HandleSessionCheckout::class,
        ],
    ],
];
