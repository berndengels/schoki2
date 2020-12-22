<?php
namespace App\Validators;

use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;

interface MySignatureValidator
{
    public function isValid(Request $request, MyWebhookConfig $config): bool;
}
