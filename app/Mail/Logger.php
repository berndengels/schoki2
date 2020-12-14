<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Logger extends Mailable
{
    use Queueable, SerializesModels;

    public $to = [[
        'name'      => 'Bernd Engels',
        'address'   => 'engels@goldenacker.de',
    ]];
    public $from = [[
        'name'      => 'Bernd Engels',
        'address'   => 'engels@goldenacker.de',
    ]];
    public $subject = 'Logger Mail';
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.text.logger')->with([
            'msg' => $this->msg
        ]);
    }
}
