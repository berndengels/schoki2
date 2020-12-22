<?php
namespace App\Webhook;

use App\Models\Webhook;
//use Spatie\WebhookClient\ProcessWebhookJob;
use Spatie\StripeWebhooks\Exceptions\WebhookFailed;
use Spatie\StripeWebhooks\ProcessStripeWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;

class MyProcessStripeWebhookJob extends ProcessStripeWebhookJob
{
    use Spatie\WebhookClient\ProcessWebhookJob;
    use Spatie\StripeWebhooks\Exceptions\WebhookFailed;

    public Webhook $webhook;

    public function __construct(Webhook $webhook)
    {
        $this->webhook = $webhook;
    }

    public function handle()
    {
        if (! isset($this->webhook->payload['type']) || $this->webhook->payload['type'] === '') {
            throw WebhookFailed::missingType($this->webhookCall);
        }

        event("stripe-webhooks::{$this->webhookCall->payload['type']}", $this->webhookCall);

        $jobClass = $this->determineJobClass($this->webhookCall->payload['type']);

        if ($jobClass === '') {
            return;
        }

        if (! class_exists($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobClass, $this->webhookCall);
        }

        dispatch(new $jobClass($this->webhookCall));
    }
}
