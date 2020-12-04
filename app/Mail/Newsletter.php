<?php

namespace App\Mail;

use App\User;
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
    public function __construct($request, $sender_name, $user, $dummy_user = NULL)
    {
        $this->request      = $request;
        $this->sender_name  = $sender_name;
        $this->user         = $user;
        $this->dummy_user   = $dummy_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.newsletter');

        $subject = "Launch of Duft Und Du.";
        
        // If $this->request->subject is null, use $subject
        // If User variable is null, use dummy user
        return $this->from($this->request->address_from, $this->sender_name)
            ->subject($this->request->subject ?: $subject)
            ->markdown('emails.newsletter')
            ->with([
                'user' => $this->user ?: $this->dummy_user,
            ]);
    }
}
