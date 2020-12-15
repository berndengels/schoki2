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
     * @var Customer
     */
    public $customer;
    /**
     * @var array
     */
    public $orderParams;
    /**
     * @var int
     */
    public $orderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( array $orderParams, int $orderId, Customer $customer )
    {
        $this->customer     = $customer;
        $this->orderParams  = $orderParams;
        $this->orderId      = $orderId;
        ShopRepository::updateOrder($orderParams, $orderId);
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
