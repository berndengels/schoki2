<?php
namespace App\Validators;

use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class PayPalSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header($config->signatureHeaderName);
        return true;
/*

        if (! $signature) {
            return false;
        }
        $signingSecret = $config->signingSecret;

        if (empty($signingSecret)) {
            throw WebhookFailed::signingSecretNotSet();
        }

        $computedSignature = hash_hmac('sha256', $request->getContent(), $signingSecret);

        return hash_equals($signature, $computedSignature);
*/
    }
}
