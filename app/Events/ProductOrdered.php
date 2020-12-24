<?php
namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use stdClass;

class ProductOrdered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var stdClass
     */
    public $invoice;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $invoice)
    {
        $this->invoice = json_decode(json_encode($invoice));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-product-order');
    }
}
