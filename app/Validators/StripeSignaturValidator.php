<?php
namespace App\Validators;

use Exception;
use Stripe\Webhook;
use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;
use Jenssegers\Agent\Facades\Agent;

class StripeSignaturValidator implements MySignatureValidator
{
    public function isValid(Request $request, MyWebhookConfig $config): bool
    {
        $ua = Agent::getUserAgent();
        if(false !== strpos($ua,'PostmanRuntime', 0) && app()->environment('local')) {
            return true;
        }
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
