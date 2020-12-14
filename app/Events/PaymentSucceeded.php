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
     * @var string
     */
    public $paymentId;
    /**
     * @var string
     */
    public $paymentType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Customer $customer,
        int $amountReceived,
        int $created,
        bool $paid,
        string $paymentId,
        string $paymentType
    )
    {
        $this->paid             = $paid;
        $this->created          = $created;
        $this->customer         = $customer;
        $this->paymentId        = $paymentId;
        $this->paymentType      = $paymentType;
        $this->amountReceived   = $amountReceived;
        $order = ShopRepository::createOrder($customer, $amountReceived, $created, $paid, $paymentId, $paymentType);
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
