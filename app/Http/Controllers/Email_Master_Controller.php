<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\Mailing_Lists;

use Mail;
use App\Mail\Mailer;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\OrderShipped;

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
        // $order = Order::findOrFail($orderId);


        // Mail::to($request->user())->send(new OrderShipped($request));
        
        
        
        // Fetching Addresses of Receivers
        if(strcmp($request->address_to, "newsletter") == 0){
            // $recipients = Mailing_Lists::whereNotNull('users_id');
            $recipients = Mailing_Lists::whereNotNull('newsletter');
        }
        else if(strcmp($request->address_to, "all_users") == 0){
            $recipients = User::all();
        }
        
        
        if($request->address_to_sec != NULL){
            // Mail to All
            if(strcmp($request->email_template_name, "hello") == 0){
                foreach ($recipients as $recipient) {
                    Mail::to($recipient)->send(new Hello($request));
                }
            }
            
            else if(strcmp($request->email_template_name, "newsletter") == 0){
                foreach ($recipients as $recipient) {
                    Mail::to($recipient)->send(new Newsletter($request));
                }
            }
    
            else if(strcmp($request->email_template_name, "change_in_terms_and_conditions") == 0){
                foreach ($recipients as $recipient) {
                    Mail::to($recipient)->send(new ChangeInTermsConditions($request));
                }
            }

            else if(strcmp($request->email_template_name, "order_shipped") == 0){
                foreach ($recipients as $recipient) {
                    Mail::to($recipient)->send(new OrderShipped($request));
                }
            }
        }
        else{
            Mail::to($request->address_to_sec)->send(new Hello($request));
        }

        // var_dump($request->email_template_name);
        // var_dump($request->address_to_sec);
        // var_dump($request->address_from);
        // var_dump($request->address_to);
        // User::all();
        return;
        return redirect()->back();
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
