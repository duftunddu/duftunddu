<?php

namespace App\Mail;

use App\User;
use App\Feature_Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Feature_Request_Complete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var user
     */
    public $user;

    /**
     * The feature instance.
     *
     * @var feature
     */
    public $feature;

    /**
     * The feature instance.
     *
     * @var failure
     */
    public $failure = FALSE;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $sender_name, $dummy_user = NULL)
    {
        $this->request      = $request;
        $this->sender_name  = $sender_name;

        $feature            = Feature_Request::where('name', $request->subject)->first();
        $this->feature      = $feature;
        // $this->request->subject = NULL;
        if (is_null($this->feature)){
            $this->failure = TRUE;
            return;
        }
        $this->user         = User::find($feature->users_id);
        if (is_null($this->user)){
            $this->failure = TRUE;
            return;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.feature_request_complete');
    
        if ($this->failure){
            dd($this->feature, $this->user);
            return redirect()->back();
        }

        $this->request->subject = NULL;

        $subject = "Your Feature Request is complete.";
        if($this->request->subject == NULL){
            return $this->from($this->request->address_from, $this->sender_name)
                ->subject($subject)
                ->markdown('emails.feature_request_complete')
                ->with([
                    'user'      => $this->user,
                    'feature'   => $this->feature,
                ]);
        }
        else{
            return $this->from($this->request->address_from, $this->sender_name)
                ->subject($this->request->subject)
                ->markdown('emails.feature_request_complete')
                ->with([
                    'user'      => $this->user,
                    'feature'   => $this->feature,
                ]);
        }
    }
}
