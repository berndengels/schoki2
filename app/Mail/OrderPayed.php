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
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $provider, Customer $customer, array $params, int $orderId)
    {
        $this->provider = $provider;
        $this->customer = $customer;
        $this->params   = $params;
        $this->orderId  = $orderId;

        $provider = $this->params['payment_provider'];
        $this->to(env('LOGGER_EMAIL'));
        $this->from(env('LOGGER_EMAIL'));
        $this->subject("Schoki Payment Success via $provider");
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
