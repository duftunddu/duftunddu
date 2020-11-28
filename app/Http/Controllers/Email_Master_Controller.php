<?php

namespace App\Http\Controllers;

use App\User;
// use App\Mail\Mailing_Lists;

use Mail;
use App\Mailing_Lists;
use App\Mail\Mailer;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\Newsletter;
use App\Mail\OrderShipped;
use App\Mail\Brand_Ambassador_Invite;

use Illuminate\Mail\Markdown;
use Illuminate\Container\Container;
// use App\Order;
// use Illuminate\Support\Facades\Mail;

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
        if($request->email_template == NULL){
            return "Looks like you forgot to select the template.";
        }

        $markdown = Container::getInstance()->make(Markdown::class);

        $html = $markdown->render("emails.{$request->email_template}");

        return view('emails.empty',[
                'html' => $html,
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
        // var_dump($sender_name);return;

        // Get the template
        $template = $this->resolve_template($request, $sender_name);

        // Send Mail
        if($request->address_to_sec != NULL){

            // Send to one address directly
            Mail::to($request->address_to_sec)->send($template);
        }
        else {

            // Get all recepients
            $recipients = $this->resolve_address($request->address_to);

            foreach ($recipients as $recipient) {
                Mail::to($recipient)->send($template);
            }
        }

        return redirect()->back();
    }

    public function resolve_address($address_to){
        
        // Fetching Addresses of Receivers
        if(strcmp($address_to, "newsletter") == 0){
            $recipients = Mailing_Lists::whereNotNull('newsletter');
        }
        else if(strcmp($address_to, "all_users") == 0){
            $recipients = User::all();
        }
        else{
            $recipients = NULL;
        }
        return $recipients;
    }

    public function resolve_template($request, $sender_name){

        // Mail to All
        if(strcmp($request->email_template_name, "hello") == 0){
            return new Hello($request, $sender_name);
        }

        else if(strcmp($request->email_template_name, "brand_ambassador_invite") == 0){
            return new Brand_Ambassador_Invite($request, $sender_name);
        }

        else if(strcmp($request->email_template_name, "newsletter") == 0){
            return new Newsletter($request, $sender_name);
        }
        
        else if(strcmp($request->email_template_name, "change_in_terms_and_conditions") == 0){
            return new ChangeInTermsConditions($request, $sender_name);
        }
        
        else if(strcmp($request->email_template_name, "order_shipped") == 0){
            return new OrderShipped($request, $sender_name);
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
