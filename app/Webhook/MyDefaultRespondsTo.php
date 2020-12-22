<?php
namespace App\Webhook;

use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;
use Symfony\Component\HttpFoundation\Response;

class MyDefaultRespondsTo implements MyRespondsToWebhook
{
    public function respondToValidWebhook(Request $request, MyWebhookConfig $config): Response
    {
        return response()->json(['message' => 'ok']);
    }
}
