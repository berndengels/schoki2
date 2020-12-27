<?php
namespace App\Validators;

use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;

class PayPalSignaturValidator implements MySignatureValidator
{
    public function isValid(Request $request, MyWebhookConfig $config): bool
    {
        return true;
    }
}
