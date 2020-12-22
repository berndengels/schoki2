<?php
namespace App\Events;

use App\Models\Customer;
use App\Models\Order;
use App\Repositories\ShopRepository;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
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
    public $orderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $provider, array $params = null, int $orderId = null, Customer $customer = null)
    {
        if($params && $orderId > 0 && $customer) {
            $this->provider = $provider;
            $this->customer = $customer;
            $this->orderId  = $orderId;
            $this->params   = $params;

            ShopRepository::updateOrder($params, $orderId);
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
