<?php
namespace App\Models;

use Exception;
use Illuminate\Http\Request;
use App\Webhook\MyWebhookConfig;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $table = 'webhook_calls';
    protected $fillable = ['name','event','payload','exception'];
    protected $guarded = [];
    protected $casts = [
        'payload' => 'array',
        'exception' => 'array',
    ];

    public static function storeWebhook(MyWebhookConfig $config, Request $request): Webhook
    {
        $input = $request->input();
        $payload = ($input);

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
        try {
            return self::create([
                'name'      => $config->name,
                'event'     => $event,
                'payload'   => $payload,
            ]);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function saveException(Exception $exception): self
    {
        $this->exception = [
            'code'      => $exception->getCode(),
            'message'   => $exception->getMessage(),
            'trace'     => $exception->getTraceAsString(),
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
