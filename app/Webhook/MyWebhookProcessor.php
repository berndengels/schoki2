<?php

namespace App\Webhook;

use Exception;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\Events\InvalidSignatureEvent;

class MyWebhookProcessor
{
    protected Request $request;
    protected MyWebhookConfig $config;

    public function __construct(Request $request, MyWebhookConfig $config)
    {
        $this->request  = $request;
        $this->config   = $config;
    }

    public function process()
    {
        $this->ensureValidSignature();
        if (! $this->config->webhookProfile->shouldProcess($this->request)) {
            return $this->createResponse();
        }
        $webhook = $this->storeWebhook();
        $this->processWebhook($webhook);
        return $this->createResponse();
    }

    protected function ensureValidSignature()
    {
        if (! $this->config->signatureValidator->isValid($this->request, $this->config)) {
            event(new InvalidSignatureEvent($this->request));
            throw WebhookFailed::invalidSignature();
        }

        return $this;
    }

    protected function storeWebhook(): Webhook
    {
        return $this->config->webhookModel::storeWebhook($this->config, $this->request);
    }

    protected function processWebhook(Webhook $webhook): void
    {
        try {
            $job = new $this->config->processWebhookJobClass($webhook);
            $webhook->clearException();
            dispatch($job)
                ->delay(now()->addSeconds(5))
            ;
        } catch (Exception $exception) {
            $webhook->saveException($exception);
            throw $exception;
        }
    }

    protected function createResponse()
    {
        return $this->config->webhookResponse->respondToValidWebhook($this->request, $this->config);
    }
}
