<?php
namespace App\Events;

use App\Models\Customer;
use App\Models\Order;
use App\Repositories\ShopRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class PaymentSucceeded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $provider;
    /**
     * @var Customer
     */
    public $customer;
    /**
     * @var array
     */
    public $params;
    /**
     * @var int
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $provider, Customer $customer = null, Order $order = null, array $params = null)
    {
        if($params && $order && $customer) {

            $order->update($params);

            $this->provider = $provider;
            $this->customer = $customer;
            $this->order    = Order::find($order->id);
            $this->params   = $params;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-payment-success');
    }
}
