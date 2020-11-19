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
    //  * @var Order
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
    public function build(Request $request)
    {
        // return (new App\Mail\OrderShipped($request))->render();
        // return $this->view('emails.hello');

        // return $this->from('example@example.com')
        // ->markdown('emails.hello');

        // return $this->from('example@example.com')
        //         ->markdown('emails.hello');

        // return $this->from($request->address_from)
        // ->markdown('emails.order_shipped');

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