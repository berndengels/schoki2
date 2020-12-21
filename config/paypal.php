<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', ''),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', ''),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
        'webhook_id'  => '6A0042816T1983623', // all events: URL/payment/paypal/webhook
        'client_id'   => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'client_secret'  => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        'api_url'   => 'https://api.sandbox.paypal.com',
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', // Used for Adaptive Payments API
        'webhook_id'  => '', // all events
        'client_id'   => env('PAYPAL_LIVE_CLIENT_ID'),
        'client_secret'  => env('PAYPAL_LIVE_CLIENT_SECRET'),
        'api_url'   => 'https://api.paypal.com',
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'EUR'),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => 'de_DE', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
