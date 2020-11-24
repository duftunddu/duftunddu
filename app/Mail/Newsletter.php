<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $sender_name)
    {
        $this->request      = $request;
        $this->sender_name  = $sender_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.newsletter');

        $subject = "";
        if($this->request->subject == NULL){
            return $this->from($this->request->address_from, $this->sender_name)
                ->subject($subject)
                ->markdown('emails.newsletter');
        }
        else{
            return $this->from($this->request->address_from, $this->sender_name)
                ->subject($this->request->subject)
                ->markdown('emails.newsletter');
        }
    }
}
