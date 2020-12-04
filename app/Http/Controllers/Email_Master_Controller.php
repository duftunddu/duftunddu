<?php

namespace App\Http\Controllers;

use App\User;
use App\Feature_Request;

use Mail;
use App\Mailing_Lists;
use App\Mail\Mailer;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\Newsletter;
use App\Mail\OrderShipped;
use App\Mail\Feature_Request_Complete;
use App\Mail\Brand_Ambassador_Invite;

use Illuminate\Mail\Markdown;
use Illuminate\Container\Container;

class Email_Master_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct() {
        $this->middleware('auth');
    }

    public function panel()
    {
        return view('admin.email_panel');
    }
    
    public function template_show(Request $request)
    {
        // $user_id = User::where('email', $request->address_from)->first();
        // if(is_null($user_id)){
        //     $user_id = 0;
        // }
        // else{
        //     $user_id = $user_id->id;
        // }
        // $email_type = $request->email_template_name;

        if($request->email_template == NULL){
            return "Looks like you forgot to select the template.";
        }

        $markdown = Container::getInstance()->make(Markdown::class);

        $html = $markdown->render("emails.{$request->email_template}");
        // [
        //     'user_id'        => $user_id,
        //     'email_type'        => $email_type,
        // ]
        

        return view('emails.empty',[
            'html' => $html,
            // 'user_id' => $user_id,
            // 'email_type' => $email_type,
        ]);
    }

    public function send(Request $request)
    {
        // Checking if sending outputs are both filled or both is_null, if so, return back.  
        if ( !( is_null($request->address_to_sec) xor is_null($request->address_to) ) ){
            return redirect()->back()->withInput($request->session()->all())->with('warning','No address specified.');
        }

        // Get the template
        $sender_name = $this->resolve_sender_name($request->address_from);

        $dummy_user = new User([
            'id'        =>  NULL,
            'name'      => 'Test',
            'email'     => 'sam_here@outlook.com',
        ]);

        // Send Mail
        if($request->address_to_sec != NULL){
            // Only one recipient

            // Get the template
            $template = $this->resolve_template($request, $sender_name, User::where('email', $request->address_to_sec)->first(), $dummy_user);

            // Send to one address directly
            Mail::to($request->address_to_sec)->send($template);

        }
        else {
            // Get all recepients
            $recipients = $this->resolve_address($request->address_to, $request);

            // Only for feature_request_complete; The subject field is used as the feature name
            // And when it is wrong, admin is returned back to email panel. 
            if(is_null($recipients)){
                return redirect()->back()->with('error', "Can't find Feature.");
            }
    
            // Sending one by one
            foreach ($recipients as $recipient) {
                
                // Get the template
                $template = $this->resolve_template($request, $sender_name, $recipient);
                Mail::to($recipient)->send($template);
            }
        }

        return redirect()->back();
    }

    public function resolve_address($address_to, $request){
        
        // Fetching Addresses of Receivers
        if(strcmp($address_to, "newsletter") == 0){
            $recipients = Mailing_Lists::whereNotNull('newsletter');
        }
        else if(strcmp($address_to, "all_users") == 0){
            $recipients = User::all();
        }
        else if(strcmp($address_to, "feature_request_complete") == 0){
            $recipients = Feature_Request::where('name', $request->subject)->get();
            if($recipients->isEmpty()){
                return NULL;
            }
            else {
                // Not using "find" cause the next method is expecting array
                $recipients = User::where('id', $recipients[0]->users_id)->get();
            }
        }
        else{
            $recipients = NULL;
        }
        return $recipients;
    }

    public function resolve_template($request, $sender_name, $user, $dummy_user = NULL){

        // Mail to All
        if(strcmp($request->email_template_name, "hello") == 0){
            return new Hello($request, $sender_name, $user);
        }

        else if(strcmp($request->email_template_name, "brand_ambassador_invite") == 0){
            return new Brand_Ambassador_Invite($request, $sender_name, $user);
        }

        else if(strcmp($request->email_template_name, "newsletter") == 0){
            return new Newsletter($request, $sender_name, $user, $dummy_user);
        }
        
        else if(strcmp($request->email_template_name, "change_in_terms_and_conditions") == 0){
            return new ChangeInTermsConditions($request, $sender_name, $user);
        }
        
        else if(strcmp($request->email_template_name, "feature_request_complete") == 0){
            return new Feature_Request_Complete($request, $sender_name, $user);
        }

        else if(strcmp($request->email_template_name, "order_shipped") == 0){
            return new OrderShipped($request, $sender_name, $user);
        }
        
    }
    
    public function resolve_sender_name($address_from){

        // Address Name
        if(strcmp($address_from, "haise@duftunddu.com") == 0){
            return "Haise | Duft Und Du";
        }

        else if(strcmp($address_from, "no-reply@duftunddu.com") == 0){
            return "Duft Und Du";
        }

        else if(strcmp($address_from, "customer_support@duftunddu.com") == 0){
            return "Customer Support | Duft Und Du";
        }
        
        else if(strcmp($address_from, "test-no-reply@duftunddu.com") == 0){
            return "Test | Duft Und Du";
        }
        
        else if(strcmp($address_from, "newsletter@duftunddu.com") == 0){
            return "Newsletter | Duft Und Du";
        }

        else if(strcmp($address_from, "ceo-no-reply@duftunddu.com") == 0){
            return "CEO | Duft Und Du";
        }

        return "Duft Und Du";
    }

    
    // public function basic_email() {
    //     $data = array('name'=>"Virat Gandhi");
     
    //     Mail::send(['text'=>'mail'], $data, function($message) {
    //        $message->to('abc@gmail.com', 'Tutorials Point')->subject
    //           ('Laravel Basic Testing Mail');
    //        $message->from('xyz@gmail.com','Virat Gandhi');
    //     });
    //     echo "Basic Email Sent. Check your inbox.";
    //  }
    //  public function html_email() {
    //     $data = array('name'=>"Virat Gandhi");
    //     Mail::send('mail', $data, function($message) {
    //        $message->to('abc@gmail.com', 'Tutorials Point')->subject
    //           ('Laravel HTML Testing Mail');
    //        $message->from('xyz@gmail.com','Virat Gandhi');
    //     });
    //     echo "HTML Email Sent. Check your inbox.";
    //  }
    //  public function attachment_email() {
    //     $data = array('name'=>"Virat Gandhi");
    //     Mail::send('mail', $data, function($message) {
    //        $message->to('abc@gmail.com', 'Tutorials Point')->subject
    //           ('Laravel Testing Mail with Attachment');
    //        $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
    //        $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
    //        $message->from('xyz@gmail.com','Virat Gandhi');
    //     });
    //     echo "Email Sent with attachment. Check your inbox.";
    //  }

}
