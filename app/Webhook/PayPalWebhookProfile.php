<?php
namespace App\Webhook;

use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookProfile\WebhookProfile;

class PayPalWebhookProfile implements WebhookProfile
{
    public function shouldProcess(Request $request): bool
    {
        // TODO: Implement shouldProcess() method.
        // "event_type": "CHECKOUT.ORDER.APPROVED",
        return true;
    }
}
