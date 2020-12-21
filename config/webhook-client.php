<?php

use App\Models\PayPalWebhookCall;
use App\Libs\PayPal\PayPalWebhookProfile;
use App\Validators\PayPalSignatureValidator;
use App\Jobs\PayPalWebhooks\HandleCheckoutOrderSuccess;
use Spatie\WebhookClient\SignatureValidator\DefaultSignatureValidator;
use Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile;
use Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo;

return [
    'configs' => [
        [
            /*
             * This package supports multiple webhook receiving endpoints. If you only have
             * one endpoint receiving webhooks, you can use 'default'.
             */
            'name' => 'default',

            /*
             * We expect that every webhook call will be signed using a secret. This secret
             * is used to verify that the payload has not been tampered with.
             */
            'signing_secret' => env('WEBHOOK_CLIENT_SECRET'),

            /*
             * The name of the header containing the signature.
             */
            'signature_header_name' => 'Signature',

            /*
             *  This class will verify that the content of the signature header is valid.
             *
             * It should implement \Spatie\WebhookClient\SignatureValidator\SignatureValidator
             */
            'signature_validator' => PayPalSignatureValidator::class,

            /*
             * This class determines if the webhook call should be stored and processed.
             */
            'webhook_profile' => PayPalWebhookProfile::class,

            /*
             * This class determines the response on a valid webhook call.
             */
            'webhook_response' => DefaultRespondsTo::class,

            /*
             * The classname of the model to be used to store call. The class should be equal
             * or extend Spatie\WebhookClient\Models\WebhookCall.
             */
            'webhook_model' => PayPalWebhookCall::class,

            /*
             * The class name of the job that will process the webhook request.
             * This should be set to a class that extends \Spatie\WebhookClient\ProcessWebhookJob.
             */
            'process_webhook_job' => HandleCheckoutOrderSuccess::class,
        ],
    ],
];
