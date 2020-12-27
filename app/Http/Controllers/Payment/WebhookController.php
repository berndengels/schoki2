<?php
namespace App\Http\Controllers\Payment;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;
use App\Webhook\MyWebhookProcessor;

/**
 * Class WebhookController
 * @package App\Http\Controllers\Payment
 */
class WebhookController
{
    /**
     * @param Request $request
     * @param MyWebhookConfig $config
     * @return JsonResponse
     */
    public function __invoke(Request $request, MyWebhookConfig $config)
    {
        (new MyWebhookProcessor($request, $config))->process();
        return response()->json(['message' => 'ok']);
    }
}
