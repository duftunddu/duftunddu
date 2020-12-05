<?php

namespace App\Mail;

use App\User;
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
        // return $this->markdown('emails.brand_ambassador_invite');

        $this->dummy_user = new User([
            'id'        =>  NULL,
            'name'      => $this->request->subject,
            'email'     => $this->request->address_to_sec,
        ]);

        $subject = "Invitation to Join Duft Und Du.";

        return $this->from($this->request->address_from, $this->sender_name)
            ->subject($subject)
            ->markdown('emails.brand_ambassador_invite')
            ->with([
                'user' => $this->user ?: $this->dummy_user,
            ]);
    }
}
