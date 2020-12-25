<?php
namespace App\Models;

use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookConfig;

/**
 * App\Models\PayPalWebhookCall
 *
 * @method static Builder|PayPalWebhookCall newModelQuery()
 * @method static Builder|PayPalWebhookCall newQuery()
 * @method static Builder|PayPalWebhookCall query()
 * @mixin Eloquent
 */
class PayPalWebhookCall extends Model
{
    protected $table = 'webhook_paypal';
    protected $guarded = [];
    protected $casts = [
        'payload' => 'array',
        'exception' => 'array',
    ];

    public static function storeWebhook(WebhookConfig $config, Request $request): PayPalWebhookCall
    {
        return self::create([
            'name' => $config->name,
            'payload' => $request->input(),
        ]);
    }

    public function saveException(Exception $exception): self
    {
        $this->exception = [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ];
        $this->save();
        return $this;
    }

    public function clearException(): self
    {
        $this->exception = null;
        $this->save();
        return $this;
    }
}
