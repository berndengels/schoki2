<?php
namespace App\Mail;

use App\Events\PaymentSucceeded;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPayed extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var PaymentSucceeded
     */
    public $paymnetSuccesss;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PaymentSucceeded $paymentSuccesss)
    {
        $this->paymnetSuccesss = $paymentSuccesss;
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
