<?php
namespace App\Validators;

use Exception;
use Stripe\Webhook;
use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;

class StripeSignatureValidator implements MySignatureValidator
{
    public function isValid(Request $request, MyWebhookConfig $config): bool
    {
        $signature  = $request->header('Stripe-Signature');
        $secret     = $config->signingSecret;

        try {
            Webhook::constructEvent($request->getContent(), $signature, $secret);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }
}
