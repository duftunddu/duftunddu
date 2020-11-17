<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    // protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.hello');

        // return $this->from('example@example.com')
                // ->view('emails.orders.shipped');
                // ->view('emails.about_us');
                // ->view('emails.about_us')
                // ->with([
                //     'orderName' => $this->order->name,
                //     'orderPrice' => $this->order->price,
                // ]);
    }
}
