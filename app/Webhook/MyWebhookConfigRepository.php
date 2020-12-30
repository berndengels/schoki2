<?php

namespace App\Webhook;

class MyWebhookConfigRepository
{
    /** @var MyWebhookConfig[] */
    protected $configs;

    public function addConfig(MyWebhookConfig $webhookConfig)
    {
        $this->configs[$webhookConfig->name] = $webhookConfig;
    }

    public function getConfig(string $name): ?MyWebhookConfig
    {
        return $this->configs[$name] ?? null;
    }
}
