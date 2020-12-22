<?php

namespace App\Webhook;

use App\Models\WebhookPaypal;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

abstract class ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public WebhookPaypal $webhookCall;

    public function __construct(WebhookPaypal $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }
}
