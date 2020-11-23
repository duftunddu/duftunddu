<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Brand_Ambassador_Invite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.brand_ambassador_invite');

        $subject = "Invitation to Join Duft Und Du.";
        if($this->request->subject == NULL){
            return $this->from($this->request->address_from)
                ->subject($subject)
                ->markdown('emails.brand_ambassador_invite');
        }
        else{
            return $this->from($this->request->address_from)
                ->subject($this->request->subject)
                ->markdown('emails.brand_ambassador_invite');
        }
    }
}
