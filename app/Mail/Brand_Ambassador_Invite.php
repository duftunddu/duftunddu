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
    // public $user_id;
    // public $email_type;
    
    /**
     * The order instance.
     *
     * @var user_id
     */
    public $user_id;

    /**
     * The order instance.
     *
     * @var email_type
     */
    public $email_type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $sender_name, $dummy_user = NULL)
    {
        $user_id = User::where('email', $request->address_from)->first();
        if(is_null($user_id)){
            $user_id = 0;
        }
        else{
            $user_id = $user_id->id;
        }
        $email_type = $request->email_template_name;

        $this->request = $request;
        $this->sender_name = $sender_name;
        $this->user_id = $user_id;
        $this->email_type = $email_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.brand_ambassador_invite');

        // var_dump($this->email_type);return;
        $this->email_type = 5;

        $subject = "Invitation to Join Duft Und Du.";

        return $this->from($this->request->address_from, $this->sender_name)
            ->subject($this->request->subject ?: $subject)
            ->markdown('emails.brand_ambassador_invite')
            ->with([
                'email_type' => $this->email_type,
                'user_id' => $this->user_id,
        ]);
    }
}
