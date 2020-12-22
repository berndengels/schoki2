<?php
namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;
use App\Webhook\MyWebhookProcessor;

class WebhookController
{
    public function __invoke(Request $request, MyWebhookConfig $config)
    {
        (new MyWebhookProcessor($request, $config))->process();
        return response()->json(['message' => 'ok']);
    }
}
