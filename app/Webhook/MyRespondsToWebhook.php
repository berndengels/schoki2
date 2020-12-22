<?php
namespace App\Webhook;

use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;
use Symfony\Component\HttpFoundation\Response;

interface MyRespondsToWebhook
{
    public function respondToValidWebhook(Request $request, MyWebhookConfig $config): Response;
}
