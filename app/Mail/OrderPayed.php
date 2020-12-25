<?php

namespace App\Mail;

use App\Models\AdminUser;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPayed extends Mailable implements ShouldQueue
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
     * @var Order
     */
    public $order;
    /**
     * @var array
     */
    public $invoice;
    /**
     * @var array
     */
    public $params;
    /**
     * @var string
     */
    public $logo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $provider, Customer $customer, Order $order, array $params)
    {
        $this->provider = $provider;
        $this->customer = $customer;
        $this->params   = $params;
        $this->order    = $order;
        $this->logo     = base64_encode(file_get_contents(public_path('img').'/logo-167x167.png'));
//        $to = AdminUser::role('Shop')->pluck('email')->toArray();
//        $this->to($to);
        $this->from(config('my.shop.email.from'));
        $this->subject("Schoki Payment Success via $provider");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.payed');
    }
}
