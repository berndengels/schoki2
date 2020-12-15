<?php
namespace App\Mail;

use App\Events\PaymentSucceeded;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPayed extends Mailable
{
    use Queueable, SerializesModels;
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
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, array $orderParams, int $orderId)
    {
        $this->customer     = $customer;
        $this->orderParams  = $orderParams;
        $this->orderId      = $orderId;

        $this->to(env('LOGGER_EMAIL'));
        $this->from(env('LOGGER_EMAIL'));
        $this->subject('payment success');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.orders.payed');
    }
}
