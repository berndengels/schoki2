<?php

use App\Jobs\StripeWebhooks\HandleSessionCheckoutAsynPaymentFailed;
use App\Jobs\StripeWebhooks\HandleSessionCheckoutAsynPaymentSucceeded;
use App\Jobs\StripeWebhooks\HandleSessionCheckoutCompleted;
use Spatie\StripeWebhooks\ProcessStripeWebhookJob;

return [

    /*
     * Stripe will sign each webhook using a secret. You can find the used secret at the
     * webhook configuration settings: https://dashboard.stripe.com/account/webhooks.
     */
    'signing_secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
     * You can define the job that should be run when a certain webhook hits your application
     * here. The key is the name of the Stripe event type with the `.` replaced by a `_`.
     *
     * You can find a list of Stripe webhook types here:
     * https://stripe.com/docs/api#event_types.
     */
    'jobs' => [
        'checkout_session_async_payment_succeeded' => HandleSessionCheckoutAsynPaymentSucceeded::class,
        'checkout_session_async_payment_failed' => HandleSessionCheckoutAsynPaymentFailed::class,
        'checkout_session_completed' => HandleSessionCheckoutCompleted::class,
    ],

    /*
     * The classname of the model to be used. The class should equal or extend
     * Spatie\StripeWebhooks\ProcessStripeWebhookJob.
     */
    'model' => ProcessStripeWebhookJob::class,
];
