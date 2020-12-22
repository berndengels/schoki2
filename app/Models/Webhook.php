<?php
namespace App\Models;

use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\Models\WebhookCall;

class Webhook extends WebhookCall
{
    protected $table = 'webhook_calls';
    protected $fillable = ['name','event','payload','exception'];

    public static function storeWebhook(WebhookConfig $config, Request $request): Webhook
    {
        $input = $request->input();
        switch(true) {
            case isset($input['event_type']):
                $event = $input['event_type'];
                break;
            case isset($input['type']):
                $event = $input['type'];
                break;
            default:
                $event = null;
        }
        $event = strtolower(substr($event, strrpos($event,'.') + 1));

        return self::create([
            'name'      => $config->name,
            'event'     => $event,
            'payload'   => $request->input(),
        ]);
    }
}
