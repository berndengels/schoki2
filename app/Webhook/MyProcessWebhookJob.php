<?php

namespace App\Webhook;

use App\Models\Webhook;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\StripeWebhooks\ProcessStripeWebhookJob as ParentJob;

abstract class MyProcessWebhookJob extends ParentJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Webhook $webhook;

    public function __construct(Webhook $webhook)
    {
        $this->webhook = $webhook;
    }
}
