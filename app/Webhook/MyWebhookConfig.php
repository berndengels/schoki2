<?php
namespace App\Webhook;

use App\Validators\MySignatureValidator;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\WebhookProfile\WebhookProfile;
use Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo;
use Spatie\WebhookClient\WebhookResponse\RespondsToWebhook;

class MyWebhookConfig
{
    public function __construct(array $properties)
    {
        $this->name = $properties['name'];
        $this->signingSecret = $properties['signing_secret'] ?? '';
        $this->signatureHeaderName = $properties['signature_header_name'] ?? '';
        $this->signatureValidator = app($properties['signature_validator']);
        $this->webhookProfile = app($properties['webhook_profile']);
        $this->webhookResponse = app($properties['webhook_response'] ?? DefaultRespondsTo::class);
        $this->webhookModel = $properties['webhook_model'];
        $this->processWebhookJobClass = $properties['process_webhook_job'];
    }
}
