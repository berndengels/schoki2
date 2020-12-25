<?php
namespace App\Mail;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use stdClass;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var stdClass
     */
    public $invoice;
    /**
     * @var Customer
     */
    public $customer;
    /**
     * @var Order
     */
    public $order;
    /**
     * @var string
     */
    public $logo;
    /**
     * @var string
     */
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(stdClass $invoice, string $token)
    {
        $this->invoice  = $invoice;
        $this->customer = Customer::whereStripeId($this->invoice->customer)->first();
        $this->order    = Order::whereCreatedBy($this->customer->id)->orderBy('created_at', 'desc')->first();
        $this->logo     = base64_encode(file_get_contents(public_path('img').'/logo-167x167.png'));
        $this->token    = $token;

//        $this->to($order->createdBy->email);
        $this->from(config('my.shop.email.from'));
        $this->subject('Deine Schokoladen Bestellung');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.shipped');
    }
}
