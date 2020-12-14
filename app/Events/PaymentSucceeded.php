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
     * @var Cart
     */
    public $cart;
    /**
     * @var int
     */
    public $amountReceived;
    /**
     * @var bool
     */
    public $paid;
    /**
     * @var int
     */
    public $created;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, Cart $cart, int $amountReceived, int $created, bool $paid = false)
    {
        $this->cart             = $cart;
        $this->paid             = $paid;
        $this->created          = $created;
        $this->customer         = $customer;
        $this->amountReceived   = $amountReceived;
        $order = ShopRepository::createOrder($customer, $cart, $amountReceived, $created, $paid);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-payment-succeeded');
    }
}
